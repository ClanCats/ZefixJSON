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
namespace ClanCats\ZefixJSON;

class Request
{
	/**
	 * Create a new instance 
	 *
	 * @param $client
	 * @param $num
	 */
	public static function create( $client )
	{
		return new static( $client );
	}

	/**
	 * The current request client
	 *
	 * @var ClanCats\ZefixJSON\Client
	 */
	protected $client = null;

	/**
	 * Create new Request instance
	 *
	 * @param ClanCats\ZefixJSON\Client 		$client
	 * @return void
	 */
	public function __construct( $client )
	{
		$this->client = $client;
	}
}