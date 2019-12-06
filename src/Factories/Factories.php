<?php
/**
 * phpgram mvc
 *
 * This File is part of the phpgram Mvc Lib
 *
 * Web: https://gitlab.com/grammm/php-gram/phpgram-mvc-lib
 *
 * @license https://gitlab.com/grammm/php-gram/phpgram-mvc-lib/blob/master/LICENSE
 *
 * @author Jörn Heinemann <joernheinemann@gmx.de>
 */

namespace Gram\Mvc\Lib\Factories;

/**
 * Class Factories
 * @package Gram\Mvc\Lib\Factories
 *
 * Main Class der Factories
 */
class Factories
{
	protected static $userClass, $view_tpl_path, $lang_path;

	public static function setUser($userClass)
	{
		self::$userClass = $userClass;
	}

	public static function setViewOptions($view_tpl_path)
	{
		self::$view_tpl_path = $view_tpl_path;
	}

	public static function setLangPath($lang_path)
	{
		self::$lang_path = $lang_path;
	}
}