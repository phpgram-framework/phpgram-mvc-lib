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
use Gram\Project\Lib\Session\SessionInterface;

/**
 * Class UserFactory
 * @package Gram\Mvc\Lib\Factories
 *
 * Gibt das UserInterface zurück
 */
class UserFactory extends Factories
{
	/**
	 * @return UserInterface
	 */
	public static function getUser()
	{
		return new self::$userClass;
	}

	/**
	 * @param SessionInterface|null $session
	 * @return UserController
	 */
	public static function getController(SessionInterface $session = null)
	{
		$session = $session ?? SessionFactory::getSession();

		return new UserController($session,self::getUser());
	}
}