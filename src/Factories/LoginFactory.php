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
	/** @var Login */
	private static $_instance=null;

	/**
	 * @return Login
	 */
	public static function login()
	{
		if(!isset(self::$_instance)){
			self::$_instance = new Login(SessionFactory::getSession(),UserFactory::getUser());
		}

		return self::$_instance;
	}

	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface|null $response
	 * @param Psr7CookieInterface|null $cookie
	 * @return Login|LoginCookie
	 */
	public static function loginCookie(
		ServerRequestInterface $request,
		ResponseInterface $response=null,
		Psr7CookieInterface $cookie=null
	){
		if($cookie===null){
			$cookie = new Psr7SimpleCookie();
		}

		return new LoginCookie(SessionFactory::getSession(),UserFactory::getUser(),$request,$response,$cookie);
	}
}