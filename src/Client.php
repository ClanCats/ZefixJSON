<?php 
/**
 * Zefix JSON Client
 ** 
 *
 * @package			ZefixJSON
 * @author			Mario Döring <mario@clancats.com>
 * @version			0.1
 * @copyright 		2014 ClanCats GmbH
 *
 */
namespace ClanCats\ZefixJSON;

class Client 
{
	
	/**
	 * The current configuration
	 *
	 * @var ClanCats\ZefixJSON\Configuration
	 */
	public $conf = null;
	
	/**
	 * Create new Client instance
	 *
	 * @param array  		$conf
	 * @return void
	 */
	public function __construct( $conf = [] )
	{
		$this->conf = new Configuration( $conf );
	}
	
	/**
	 * Request data of a HR number
	 *
	 * @param string 			$num
	 * @return ClanCats\ZefixJSON\Request\Detail
	 */
	public function request( $num )
	{
		return new Request\Detail( $num );
	}
}