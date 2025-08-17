<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\pmsearch\tests\search;


require_once dirname(__FILE__) . '/../../../../../../tests/test_framework/phpbb_search_test_case.php';
/**
 * @group search
 */


class native_test extends \phpbb_search_test_case
{
	protected $db;
	protected $search;
	protected $user;
	/**
	 * Define the extensions to be tested
	 *
	 * @return array vendor/name of extension(s) to test
	 */
	static protected function setup_extensions()
	{
		return array('anavaro/pmsearch');
	}
	/**
	 * Get data set fixtures
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/fixture.xml');
	}

	protected function setUp() : void
	{
		global $phpbb_root_path, $phpEx, $config, $user, $cache;
		parent::setUp();
		// dbal uses cache
		$cache = new \phpbb_mock_cache();
		$this->db = $this->new_dbal();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$error = null;
		$class = self::get_search_wrapper('\anavaro\pmsearch\search\pmsearch_fulltext_native');
		if (PHP_VERSION_ID > 70399)
		{
			$errorlevel=error_reporting();
			error_reporting(0);
		}
		$user->data['user_id'] = 2;
		if (PHP_VERSION_ID > 70399)
		{
			error_reporting($errorlevel);
		}
		$this->search = new $class($error, $phpbb_root_path, $phpEx, null, $config, $this->db, $user, $phpbb_dispatcher);
	}

	public function test_user_search()
	{
		$count = 0;
		$test_ary = array();
		$all_ids = $this->search->user_search('test', $test_ary, $count, 5);
		$this->assertEquals(false, $all_ids);
		$all_ids = $this->search->user_search(5, $test_ary, $count, 5);
		$this->assertEquals(1, $all_ids);
		$all_ids = $this->search->user_search(10, $test_ary, $count, 5);
		$this->assertEquals(2, $all_ids);
	}
}
