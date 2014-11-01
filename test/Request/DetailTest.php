<?php 

namespace ClanCats\ZefixJSON\Request\Test;

use ClanCats\ZefixJSON\Client;
use ClanCats\ZefixJSON\Request\Detail;

class DetailTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Tests request construct
	 */
	public function testConstruct()
	{	
		$request = new Detail( new Client );

		$this->assertInstanceOf( 'ClanCats\ZefixJSON\Request\Detail', $request );	
		
	}

	/**
	 * Tests detail request
	 */
	public function testDetail()
	{
		//$client = new Client;

		//$client->detail('CHE-155.686.973');
	}
}