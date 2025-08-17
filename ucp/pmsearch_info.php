<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\pmsearch\ucp;

/**
 */
class pmsearch_info
{
	function module()
	{
		return [
			'filename'	=> '\anavaro\pmsearch\ucp\pmsearch_module',
			'title'		=> 'UCP_PMSEARCH',
			'modes'		=> [
				'search'	=> [
					'title'		=> 'UCP_PMSEARCH',
					'auth'		=> 'ext_anavaro/pmsearch',
					'cat'		=> ['UCP_PM'],
				],
			],
		];
	}
}
