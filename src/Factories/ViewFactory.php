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

use Gram\Project\Lib\View\LanguageInterface;
use Gram\Project\Lib\View\StdViewInterface;
use Gram\Project\Lib\View\View;

/**
 * Class ViewFactory
 * @package Gram\Mvc\Lib\Factories
 *
 * Gibt entweder den View Path oder gleich ein View Object zurück
 */
class ViewFactory extends Factories
{
	/**
	 * @param LanguageInterface|null $language
	 * @return StdViewInterface
	 */
	public static function getView(?LanguageInterface $language = null)
	{
		return new View(self::$view_tpl_path,$language);
	}

	public static function getViewPath()
	{
		return self::$view_tpl_path;
	}

	public static function getLangPath()
	{
		return self::$lang_path;
	}

	public static function languageUsage()
	{
		return self::$view_language_usage ?? false;
	}
}