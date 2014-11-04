<?php 
/**
 * Zefix JSON Result
 ** 
 *
 * @package			ZefixJSON
 * @author			Mario Döring <mario@clancats.com>
 * @version			0.1
 * @copyright 		2014 ClanCats GmbH
 *
 */
namespace ClanCats\ZefixJSON;

class Result extends DataModel
{
	/**
	 * The result defaults
	 *
	 * @var array
	 */
	protected $defaults = [];

	/**
	 * Create new Result instance
	 *
	 * @param ClanCats\ZefixJSON\Client 		$client
	 * @return void
	 */
	public function __construct( array $data = [] )
	{
		$this->_model_data = $this->defaults;
		
		foreach( $data as $key => $value )
		{
			$this->__set( $key, $value );
		}
	}
}