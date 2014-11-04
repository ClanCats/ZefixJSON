<?php 
/**
 * Zefix JSON Configuration
 ** 
 *
 * @package			ZefixJSON
 * @author			Mario Döring <mario@clancats.com>
 * @version			0.1
 * @copyright 		2014 ClanCats GmbH
 *
 */
namespace ClanCats\ZefixJSON;

use ClanCats\ZefixJSON\Exception;

class DataModel
{
	/**
	 * The current data holder
	 *
	 * @var array
	 */
	protected $_model_data = [];

	/**
	 * Magic get a value from the object
	 *
	 * @param $key 
	 * @return mixed
	 */
	public function & __get( $key ) 
	{
		$value = null;
		
		if ( isset( $this->_model_data[$key] ) )
		{
			$value = $this->_model_data[$key];
		}
		
		$modifier_name = 'getModifier'.ucfirst( $key );
		
		if ( method_exists( $this, $modifier_name ) )
		{
			$value = call_user_func_array( [ $this, $modifier_name ], [ $value ] );
		}
		
		return $value;
	}

	/**
	 * Magic set data to the object.
	 *
	 * @param $key
	 * @param $value
	 * @return void
	 */
	public function __set( $key, $value ) 
	{
		$modifier_name = 'setModifier'.ucfirst( $key );

		if ( method_exists( $this, $modifier_name ) )
		{
			$value = call_user_func_array( [ $this, $modifier_name ], [ $value ] );
		}

		$this->_model_data[$key] = $value;
	}

	/**
	 * Magic check if data isset
	 *
	 * @param $key
	 * @return bool
	 */
	public function __isset( $key ) 
	{
		return isset( $this->_model_data[$key] );
	}

	/**
	 * Magic delete data  
	 *
	 * @param $key
	 * @return void
	 */
	public function __unset( $key ) 
	{
		unset( $this->_model_data[$key] );
	}
}