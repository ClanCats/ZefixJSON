<?php 
/**
 * Zefix JSON Detail Request
 ** 
 *
 * @package			ZefixJSON
 * @author			Mario Döring <mario@clancats.com>
 * @version			0.1
 * @copyright 		2014 ClanCats GmbH
 *
 */
namespace ClanCats\ZefixJSON\Request;

use ClanCats\ZefixJSON\Request;
use ClanCats\ZefixJSON\Exception;
use ClanCats\ZefixJSON\Result\Entry;

class Detail extends Request implements RequestInterface
{
	/**
	 * The HR company name
	 *
	 * @var string
	 */
	protected $company_num = null;
	
	/**
	 * The HR company name
	 *
	 * @var Result\Entry
	 */
	protected $result = null;
	
	/**
	 * Perform the request
	 *
	 * @param array 			$params
	 * @return self
	 */
	public function prepare( array $params )
	{
		if ( !isset( $params['num'] ) || empty( $params['num'] ) )
		{
			throw new Exception( "Requset\\Detail::prepare - No company number given." );
		}
		
		// assign the company number
		$this->company_num = $params['num'];
		
		return $this;
	}
	
	/**
	 * Perform the request
	 *
	 * The detail request needs at the moment 3 requests, because I could not find a way around this
	 * Maybe im just blind so if anyone knows a better way please correct me.
	 *
	 * 1. Use zefix search to get the link to the correct department and the detail data document.
	 * 2. Load the detail data to find the link to the xml document.
	 * 3. finally load and parse the xml document.
	 *
	 * @return self
	 */
	public function perform()
	{
		$response = $this->http->post( $this->client->conf->zefix['search'], [
			'body' => [
				'language' => $this->client->conf->language,
				'id' => $this->company_num
			]
		]);
		
		$links = htmlqp( (string) $response->getBody(), 'a' );
		$detail_page = null;
		
		foreach( $links as $link )
		{
			if ( strpos( $link->text(), $this->company_num ) !== false )
			{
				$detail_page = $link->attr( 'href' ); break;
			}
		}
		
		// check if we got an url to the detail page
		if ( is_null( $detail_page ) || empty( $detail_page ) )
		{
			throw new Exception( "Requset\\Detail::perform - Could not resolve companies detail page." );
		}
		
		// now that we have the link to the detail page we can request it and search for the 
		// xml document link
		$response = $this->http->get( $detail_page );
		
		$links = htmlqp( (string) $response->getBody(), 'a' );
		$xml_link = null;
		
		foreach( $links as $link )
		{
			if ( strtolower( trim( $link->text() ) ) === '<excerpt>' )
			{
				$xml_link = $link->attr( 'href' ); break;
			}
		}
		
		// check if we got an url to the xml document
		if ( is_null( $xml_link ) || empty( $xml_link ) )
		{
			throw new Exception( "Requset\\Detail::perform - Could not find xml document link on detail page." );
		}
		
		// finally get the xml document
		$this->parse_xml_response( $this->http->get( $xml_link )->xml() );
		
		return $this;
	}
	
	/**
	 * Parse the xml document into the current result
	 *
	 * @param xml		$xml
	 * @return void
	 */
	private function parse_xml_response( $xml )
	{
		//print_r( $xml );
		
		$this->result = new Entry(
		[
			// the entry status
			'status' => (string) $xml->instances->instance->heading->entityStatus,
			
			// base info
			'name' => (string) $xml->instances->instance->rubrics->names->name->native,
			'chnum' => (string) $xml->instances->instance->attributes()->CHNum,
			'canton' => (string) $xml->instances->instance->heading->canton,
			
			// legal form
			'legal_form' => (string) $xml->instances->instance->heading->legalForm,
			'legal_form_text' => (string) $xml->instances->instance->heading->legalFormText,
			
			// department
			'office_name' => (string) $xml->envelope->officeName,
			'office_id' => (int) $xml->envelope->officeID,
			'inscription' => (string) $xml->instances->instance->heading->inscriptionDate,
			
		]);
		
		//var_dump( $this->result ); die;
	}
	
	/**
	 * Get the data of the request
	 *
	 * @return array
	 */
	public function result()
	{
		return $this->result;
	}
}