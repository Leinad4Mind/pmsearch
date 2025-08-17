<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* Brazilian Portuguese translation by eunaumtenhoid (c) 2017 [ver 1.0.0] 
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'PMSEARCH_TITLE'	=> 'Pesquise em MPs',
	'PMSEARCH_KEYWORDS_EXPLAIN'	=>	'Coloque + na frente de uma palavra que deve ser encontrada e - na frente de uma palavra que não deve ser encontrada. Coloque uma lista de palavras separadas por | entre parênteses se apenas uma das palavras deve ser encontrada. Use * como um curinga para partidas parciais.',
	'SEARCH_ALL_TERMS'	=>	' Procure todos os termos ou use a consulta como inserida',
	'SEARCH_ANY_TERMS'	=>	'Procure por quaisquer termos',
	'NO_RESULTS_FOUND'	=> 'Nenhum resultado encontrado.',
	'SEARCH_PMS'	=> 'Pesquisar MPs',
	'ACCESS_DENIED'	=> 'Você não tem autoridade para pesquisar em MPs',

	// Added in version 1.0.1
	'SEARCH_FOR_NICK'	=> 'Search with nick',
	'SEARCH_WITH_USER'	=> 'Search',
	'SEARCH_WITH_USER_LANG'	=> 'Show conversations with user',
));
