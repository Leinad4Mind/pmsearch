<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\pmsearch\tests\functional;

/**
* @group functional
*/
class pmsearch_acp_test extends pmsearch_base
{
	public function test_install()
	{
		//add users so we can send messages and search
		$this->create_user('testuser1');
		$this->add_user_group('REGISTERED', array('testuser1'));
		
		$this->login();
		$this->admin_login();
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$this->assertContainsLang('PMSEARCH_ADMIN', $crawler->text());
		
		$this->logout();
	}
	public function test_event_auto_index()
	{
		$this->login();
		$message_id = $this->create_private_message('Test private message', 'This test private message sent testing framework. need check event indexing.', array($this->get_user_id('testuser1')));
		
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$this->assertContains('11', $crawler->filter('#indexed_words')->text());
		$this->assertContains('14', $crawler->filter('#relative_indexes')->text());
		
		$this->logout();
	}
	
	public function test_acp_delete_index()
	{
		$this->login();
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$form = $crawler->selectButton($this->lang('DELETE_INDEX'))->form();
		$crawler = self::submit($form);
		
		//test step 3 begins
		$this->assertContains('0', $crawler->filter('#indexed_words')->text());
		$this->assertContains('0', $crawler->filter('#relative_indexes')->text());
		
		$this->logout();
	}
	public function test_acp_build_index()
	{
		$this->login();
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$form = $crawler->selectButton($this->lang('CREATE_INDEX'))->form();
		$crawler = self::submit($form);
		
		//test step 3 begins
		$this->assertContains('11', $crawler->filter('#indexed_words')->text());
		$this->assertContains('14', $crawler->filter('#relative_indexes')->text());
		
		$this->logout();
	}
	public function test_search()
	{
		$this->login();
		$message_id = $this->create_private_message('Test PM', 'This test PM will not contain words that stand for pm, so we can search for them.', array($this->get_user_id('testuser1')));
		$message_id = $this->create_private_message('Test PM 1', 'This test PM will not contain words that stand for pm, so we can search for them. And it is the second pm', array($this->get_user_id('testuser1')));
		$message_id = $this->create_private_message('Test PM 3', 'This test PM will not contain words that stand for pm, so we can search for them. And it is the third pm', array($this->get_user_id('testuser1')));
		$message_id = $this->create_private_message('Test PM 4', 'This test PM will not contain words that stand for pm, so we can search for them. And it is the fourth pm', array($this->get_user_id('testuser1')));
		
		$this->logout();
		
		//get user to log in
		$this->login('testuser1');
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_ucp_pmsearch');
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'Test';
		
		
		$crawler = self::submit($form);
		
		$this->assertContains('5', $crawler->filter('.pagination')->text());
		
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'private';
		$crawler = self::submit($form);
		
		$this->assertContains('1', $crawler->filter('.pagination')->text());
		//$this->assertContains('alalaalalalalala', $crawler->text());
		$this->logout();
	}
	public function test_remove_pm_one_way()
	{
		// Log in as user and delete some mssages
		$this->login('testuser1');
		
		$crawler = self::request('GET', 'ucp.php?i=pm&folder=inbox');
		
		$this->add_lang('ucp');
		$this->add_lang('mcp');
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=0&p=5');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=0&p=4');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=0&p=3');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=0&p=2');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$this->logout();
		
		// Login as admin - indexes should be as follows
		$this->login();
		
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$this->assertContains('26', $crawler->filter('#indexed_words')->text());
		$this->assertContains('75', $crawler->filter('#relative_indexes')->text());
		//$this->assertContains('alalaalalalalala', $crawler->text());
		
		$this->logout();
	}
	public function test_search_one_sided_there()
	{
		$this->login();
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_ucp_pmsearch');
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'second';
		
		
		$crawler = self::submit($form);
		
		$this->assertContains('1', $crawler->filter('.pagination')->text());
		
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'private';
		$crawler = self::submit($form);
		
		$this->assertContains('1', $crawler->filter('.pagination')->text());
		//$this->assertContains('alalaalalalalala', $crawler->text());
		$this->logout();
	}
	public function test_search_one_sided_gone()
	{
		$this->login('testuser1');
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_ucp_pmsearch');
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'second';
		
		
		$crawler = self::submit($form);
		
		$this->assertContainsLang('NO_RESULTS_FOUND', $crawler->text());
		
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$form = $crawler->selectButton($this->lang('SEARCH_PMS'))->form();
		$form['keywords'] = 'private';
		$crawler = self::submit($form);
		
		$this->assertContains('1', $crawler->filter('.pagination')->text());
		//$this->assertContains('alalaalalalalala', $crawler->text());
		$this->logout();
	}
	public function test_delete_second_side_and_index()
	{
		$this->login();
		
		$crawler = self::request('GET', 'ucp.php?i=pm&folder=sentbox');
		
		$this->add_lang('ucp');
		$this->add_lang('mcp');
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=-1&p=5');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=-1&p=4');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=-1&p=3');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=-1&p=2');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		//test step 3 begins
		$this->assertContains('26', $crawler->filter('#indexed_words')->text());
		$this->assertContains('14', $crawler->filter('#relative_indexes')->text());
		
		$this->logout();
	}
	
	public function test_delete_indexes_of_unread_messages()
	{
		$this->login();
		
		$message_id = $this->create_private_message('Test private message 6', 'This should delete indexes of unread messages.', array($this->get_user_id('testuser1')));
		
		$this->admin_login();
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$this->assertContains('31', $crawler->filter('#indexed_words')->text());
		$this->assertContains('23', $crawler->filter('#relative_indexes')->text());
		
		$this->add_lang('ucp');
		$this->add_lang('mcp');
		
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&action=delete&f=-2&p=6');
		$form = $crawler->selectButton('Yes')->form();
		$crawler = self::submit($form);
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_acp_pmsearch');
		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-pmsearch-acp-acp_pmsearch_module&mode=main&sid=' . $this->sid);
		
		$this->assertContains('31', $crawler->filter('#indexed_words')->text());
		$this->assertContains('14', $crawler->filter('#relative_indexes')->text());
		
		
		$this->logout();
	}
	/*public function test_permission()
	{
		$this->login();
		$this->admin_login();
		$this->add_lang('acp/permissions');
		
		// User permissions
		$crawler = self::request('GET', 'adm/index.php?i=acp_permissions&icat=16&mode=setting_user_global&sid=' . $this->sid);
		$this->assertContains($this->lang('ACP_USERS_PERMISSIONS_EXPLAIN'), $this->get_content());

		// Select testuser1
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$data = array('username[0]' => 'testuser1');
		$form->setValues($data);
		$crawler = self::submit($form);
		$this->assertContains($this->lang('ACL_SET'), $crawler->filter('h1')->eq(1)->text());
		
		$form = $crawler->selectButton($this->lang('APPLY_PERMISSIONS'))->form();
		$data = array(
			'setting'	=> array(
				$this->get_user_id('testuser1')	=> array(
					0	=> array(
						'u_pmsearch' => '0'
					)
				),
			),
		);
		$form->setValues($data);
		$crawler = self::submit($form);
		
		$this->assertContainsLang('AUTH_UPDATED', $crawler->filter('html')->text());
		
		$this->logout();
		
		$this->login('testuser1');
		
		$this->add_lang_ext('anavaro/pmsearch', 'info_ucp_pmsearch');
		$crawler = self::request('GET', 'ucp.php?i=\anavaro\pmsearch\ucp\ucp_pmsearch_module&mode=search');
		
		$this->assertContainsLang('ACCESS_DENIED', $crawler->filter('html')->text());
		
		$this->logout();
	}*/
}
?>