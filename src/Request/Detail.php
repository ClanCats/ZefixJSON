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

class Detail extends Request implements RequestInterface
{
	/**
	 * The HR company name
	 *
	 * @var string
	 */
	protected $company_num = null;
	
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
		
		return $this;
	}
	
	/**
	 * Perform the request
	 *
	 * @return self
	 */
	public function perform()
	{
		return $this;
	}
	
	/**
	 * Get the data of the request
	 *
	 * @return array
	 */
	public function result()
	{
		
	}
}