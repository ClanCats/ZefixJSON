<?php 

namespace ClanCats\ZefixJSON\Test;

use ClanCats\ZefixJSON\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Tests client construct
	 */
	public function testConstruct()
	{
		$client = new Client;

		$this->assertInstanceOf( 'ClanCats\ZefixJSON\Client', $client );	
		$this->assertInstanceOf( 'ClanCats\ZefixJSON\Configuration', $client->conf );
	}
}