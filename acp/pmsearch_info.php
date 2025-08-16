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
	function module()
	{
		return array(
			'filename'	=> 'anavaro\pmsearch\acp\acp_pmsearch_module',
			'title'		=> 'ACP_PMSEARCH_GRP',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'main'		=> array(
					'title'		=> 'ACP_PRVOPT',
					'auth' 		=> 'ext_anavaro/pmsearch && acl_a_user',
					'cat'		=> array('ACP_PMSEARCH_GRP')
				),
			),
		);
	}
}
