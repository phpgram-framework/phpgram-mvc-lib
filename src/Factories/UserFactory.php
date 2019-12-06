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

use Gram\Project\Lib\Authenticate\UserController;
use Gram\Project\Lib\Authenticate\UserInterface;

/**
 * Class UserFactory
 * @package Gram\Mvc\Lib\Factories
 *
 * Gibt das UserInterface zurück
 */
class UserFactory extends Factories
{
	/** @var UserInterface */
	private static $user_instance=null;

	/** @var UserController */
	private static $controller_instance=null;


	/**
	 * @return UserInterface
	 */
	public static function getUser()
	{
		if(!isset(self::$user_instance)){
			self::$user_instance = new self::$userClass;
		}

		return self::$user_instance;
	}

	/**
	 * @return UserController
	 */
	public static function getController()
	{
		if(!isset(self::$controller_instance)){
			self::$controller_instance = new UserController(SessionFactory::getSession(),self::getUser());
		}

		return self::$controller_instance;
	}
}