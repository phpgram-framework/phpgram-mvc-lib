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

use Gram\Project\Lib\Authenticate\Login;
use Gram\Project\Lib\Authenticate\LoginCookie;
use Gram\Project\Lib\Cookie\Psr7CookieInterface;
use Gram\Project\Lib\Cookie\Psr7SimpleCookie;
use Gram\Project\Lib\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class LoginFactory
 * @package Gram\Mvc\Lib\Factories
 *
 * Gibt ein Login bzw Login Cookie Service zurück
 */
class LoginFactory extends Factories
{
	/**
	 * @param SessionInterface|null $session
	 * @return Login
	 */
	public static function login(SessionInterface $session = null)
	{
		$session = $session ?? SessionFactory::getSession();

		return new Login($session,UserFactory::getUser());
	}

	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface|null $response
	 * @param SessionInterface|null $session
	 * @param Psr7CookieInterface|null $cookie
	 * @return LoginCookie
	 */
	public static function loginCookie(
		ServerRequestInterface $request,
		ResponseInterface $response=null,
		SessionInterface $session = null,
		Psr7CookieInterface $cookie=null
	){
		$cookie = $cookie ?? new Psr7SimpleCookie();

		$session = $session ?? SessionFactory::getSession();

		return new LoginCookie($session,UserFactory::getUser(),$request,$response,$cookie);
	}
}