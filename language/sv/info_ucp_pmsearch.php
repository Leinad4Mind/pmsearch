<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
* Swedish translation by Holger (http://www.maskinisten.net)
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
	'PMSEARCH_TITLE'	=> 'Sök inom PM',
	'PMSEARCH_KEYWORDS_EXPLAIN'	=>	'Använd + framför ord som måste hittas och - framför ord som ej får hittas. Använd en lista av ord separerad med | i en parantes om endast ett av orden får hittas. Använd * som platshållare.',
	'SEARCH_ALL_TERMS'	=>	'Sök alla sökord eller använd sökkriterierna som de angivits',
	'SEARCH_ANY_TERMS'	=>	'Sök något av sökorden',
	'NO_RESULTS_FOUND'	=> 'Inga sökresultat',
	'SEARCH_PMS'	=> 'Sök inom PM',
	'ACCESS_DENIED'	=> 'Du är ej behörig att söka inom PM',

	// Added in version 1.0.1
	'SEARCH_FOR_NICK'	=> 'Search with nick',
	'SEARCH_WITH_USER'	=> 'Search',
	'SEARCH_WITH_USER_LANG'	=> 'Show conversations with user',
));
