<?php 
/**
 * Zefix JSON Request
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
	 * Create new Request instance
	 *
	 * @param $params...
	 * @return void
	 */
	public function __construct()
	{
		$this->perform( fnc_get_args() );
	}
	
	
}