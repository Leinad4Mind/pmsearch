<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\pmsearch\acp;

/**
* @package module_install
*/
class pmsearch_info
{
	public function module()
	{
		return [
			'filename'	=> '\anavaro\pmsearch\acp\pmsearch_module',
			'title'		=> 'ACP_PMSEARCH',
			'modes'		=> [
				'index'		=> [
					'title'		=> 'ACP_PMSEARCH',
					'auth' 		=> 'ext_anavaro/pmsearch && acl_a_user && acl_a_board',
					'cat'		=> ['ACP_CAT_DATABASE'],
				],
			],
		];
	}
}
