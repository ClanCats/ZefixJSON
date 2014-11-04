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

class Configuration extends DataModel
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
		
		// zefix endpoints
		'zefix' => 
		[
			'search' => 'http://zefix.admin.ch/WebServices/Zefix/Zefix.asmx/SearchFirm',
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
	 * Create new Configuration instance
	 *
	 * @param array  		$conf
	 * @return void
	 */
	public function __construct( $conf = [] )
	{
		$this->_model_data = $this->default_configuration_values;
		
		foreach( $conf as $key => $value )
		{
			$this->__set( $key, $value );
		}
	}
}