<?php 
/**
 * Zefix JSON Request Interface
 ** 
 *
 * @package			ZefixJSON
 * @author			Mario Döring <mario@clancats.com>
 * @version			0.1
 * @copyright 		2014 ClanCats GmbH
 *
 */
namespace ClanCats\ZefixJSON\Request;

interface RequestInterface 
{
	/**
	 * Perform the request
	 *
	 * @param array 			$params
	 * @return self
	 */
	public function prepare( $params );
	
	/**
	 * Perform the request
	 *
	 * @return self
	 */
	public function perform();
	
	/**
	 * Get the data of the request
	 *
	 * @return array
	 */
	public function result();
}