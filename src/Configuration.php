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

class Configuration 
{
	/**
	 * The default configuration 
	 *
	 * @var array
	 */
	protected $default_configuration_values = 
	[
		// the http client user agent
		'userAgent' => null,
		
		// the current language
		'langauge' => '1',
		
		// HR Language parameter
		'availableLanguages' => 
		[
			'1' => 'de',
			'2' => 'fr',
			'3' => 'it',
			'4' => 'en' 
		],
	];
	
	/**
	 * Set modifier language 
	 *
	 * @param string 			$lang
	 * @return string
	 */
	protected function setModifierLanguage( $lang )
	{
		if ( is_string( $lang ) && !is_numeric( $lang ) )
		{
			if ( !in_array( $lang, $this->availableLanguages ) )
			{
				throw new Exception( "Configuration::setLanguage - invalid language '".$lang."'." );
			}
			
			$available = array_flip( $this->availableLanguages );
			
			$lang = $available[ $lang ];
		}
		else
		{
			if ( !in_array( $lang, array_keys( $this->availableLanguages ) ) )
			{
				throw new Exception( "Configuration::setLanguage - invalid language key '".$lang."'." );
			}
		}
		
		return $lang;
	}
	
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
		$this->configuration = $this->default_configuration_values;
		
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
			$value = call_user_func_array( [ $this, $modifier_name ], [ $value ] );
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