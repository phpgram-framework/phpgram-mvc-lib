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

use Gram\Project\Lib\Session\RequestSession\RequestSession;
use Gram\Project\Lib\Session\SessionInterface;
use Gram\Project\Lib\Session\StdPhpSession;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SessionFactory
 * @package Gram\Mvc\Lib\Factories
 *
 * Gibt ein Session Interface der normalen Session zurück
 */
class SessionFactory extends Factories
{
	/** @var SessionInterface */
	private static $session;

	/**
	 * @return SessionInterface
	 */
	public static function getSession()
	{
		if(!isset(self::$session)){
			self::$session = new StdPhpSession();
		}

		return self::$session;
	}

	/**
	 * @param ServerRequestInterface $request
	 * @return SessionInterface
	 */
	public static function getRequestSession(ServerRequestInterface $request)
	{
		return $request->getAttribute(RequestSession::class);
	}
}