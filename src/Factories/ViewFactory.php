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
	 * @return StdViewInterface
	 */
	public static function getView()
	{
		return new View(self::$view_tpl_path);
	}

	public static function getViewPath()
	{
		return self::$view_tpl_path;
	}
}