<?php 

namespace ClanCats\ZefixJSON\Test;

use ClanCats\ZefixJSON\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test configuration construct
	 */
	public function testConstruct()
	{
		$conf = new Configuration;
		$this->assertInstanceOf( 'ClanCats\ZefixJSON\Configuration', $conf );
	}

	/**
	 * Test set language  
	 */
	public function testSetLanguage()
	{
		$conf = new Configuration;
		$conf->language = 'it';
		
		$this->assertEquals( '3', $conf->language );
		
		$conf->language = 'fr';
		$this->assertEquals( '2', $conf->language );
		
		$conf->language = '4';
		$this->assertEquals( '4', $conf->language );
	}
}