<?php
/**
*
* @package PM Search
* @copyright (c) 2013 Lucifer | 2025 Leinad4Mind
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
	'PMSEARCH_TITLE'	=> 'Търсене в личните съощения',
	'PMSEARCH_KEYWORDS_EXPLAIN'	=>	'Сложете + пред думата която трябва да е съдържа и - пред думата която не трябва. Сложете лист от думи разделение с | в скоби ако само една от тези думи трябва се намери. Използвай * за wildcard за частични съвпадения.',
	'SEARCH_ALL_TERMS'	=>	'Търси за всички въведени термини',
	'SEARCH_ANY_TERMS'	=>	'Търси за всеки от въведените термини',
	'NO_RESULTS_FOUND'	=> 'Няма намерени резултати',
	'SEARCH_PMS'	=> 'Търси в личните съощения',
	'ACCESS_DENIED'	=> 'Нямате право да търсите в личните съобщения',

	// Added in version 1.0.1
	'SEARCH_FOR_NICK'	=> 'Търси за ник',
	'SEARCH_WITH_USER'	=> 'Търси',
	'SEARCH_WITH_USER_LANG'	=> 'Покажи кореспонденция с потребителя',
));
