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

class Configuration 
{
	/**
	 * The default configuration 
	 *
	 * @var array
	 */
	protected $default_configuration_values = 
	[
		'userAgent' => null,
	];
	
	/**
	 * The current configuration
	 *
	 * @var array
	 */
	protected $configuration = [];

	/**
	 * Create new Configuration instance
	 *
	 * @param array  		$conf
	 * @return void
	 */
	public function __construct( $conf = [] )
	{
		foreach( $conf as $key => $value )
		{
			$this->__set( $key, $value );
		}
	}
	
	/**
	 * Magic get a value from the object
	 *
	 * @param $key 
	 * @return mixed
	 */
	public function & __get( $key ) 
	{
		return $this->configuration[$key];
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
			$value = call_user_func( $this, $modifier_name );
		}
		
		$this->configuration[$key] = $value;
	}
	
	/**
	 * Magic check if data isset
	 *
	 * @param $key
	 * @return bool
	 */
	public function __isset( $key ) 
	{
		return isset( $this->configuration[$key] );
	}
	
	/**
	 * Magic delete data  
	 *
	 * @param $key
	 * @return void
	 */
	public function __unset( $key ) 
	{
		unset( $this->configuration[$key] );
	}
}