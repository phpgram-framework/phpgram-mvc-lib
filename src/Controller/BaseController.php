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

namespace Gram\Mvc\Lib\Controller;

use Gram\Mvc\Lib\Factories\SessionFactory;
use Gram\Mvc\Lib\Factories\ViewFactory;
use Gram\Middleware\Classes\ClassInterface;
use Gram\Middleware\Classes\ClassTrait;
use Gram\Project\Lib\Cookie\Psr7CookieInterface;
use Gram\Project\Lib\Cookie\Psr7SimpleCookie;
use Gram\Project\Lib\Input;
use Gram\Project\Lib\Session\SessionInterface;
use Gram\Project\Lib\View\Language;
use Gram\Project\Lib\View\LanguageInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class BaseController
 * @package Gram\Mvc\Lib\Controller
 *
 * Basis Controller der weitere Methods enthält:
 *
 * Input mit Psr 7
 * View mit dem ViewInterface
 * Session mit dem SessionInterface (wahlweise Request oder normale Session)
 * Sprache mit dem LanguageInterface (ebenfalls mit dem View Interface verknpüft)
 */
abstract class BaseController implements ClassInterface
{
	use ClassTrait, ControllerInputTrait, ControllerViewTrait;

	const ALTERNATIVE_SESSION = 1;

	/** @var SessionInterface */
	protected $sessionClass;

	/** @var LanguageInterface */
	protected $language;

	/** @var Psr7CookieInterface */
	protected $cookie;

	/**
	 * Hole die Session Class
	 *
	 * Jenachdem was eingestellt wurde
	 *
	 * @param ServerRequestInterface $request
	 * @return SessionInterface
	 */
	public static function getSessionClass(ServerRequestInterface $request)
	{
		if(getenv("ALTERNATIVE_SESSION") == self::ALTERNATIVE_SESSION) {
			//Session aus dem Request
			return SessionFactory::getRequestSession($request);
		}else{
			//Normale Php Session
			return SessionFactory::getSession();
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function getInputClass()
	{
		if($this->input === null){
			$input = $this->request->getAttribute('InputClass',null);

			if($input===null){
				$this->input = new Input($this->request);
			}
		}

		return $this->input;
	}

	/**
	 * @inheritdoc
	 */
	protected function initView()
	{
		if($this->view === null){
			//nur wenn Language genutzt werden soll
			if(ViewFactory::languageUsage()) {
				$lang = $this->getLanguage();
			} else {
				$lang = null;
			}

			$this->view = ViewFactory::getView($lang);
		}
	}

	/**
	 * @return SessionInterface
	 */
	protected function getSession()
	{
		if(!isset($this->sessionClass)) {
			$this->sessionClass = self::getSessionClass($this->request);
		}

		return $this->sessionClass;
	}

	/**
	 * @return Psr7CookieInterface
	 */
	protected function getCookie()
	{
		if(!isset($this->cookie)) {
			$this->cookie = new Psr7SimpleCookie();
		}

		return $this->cookie;
	}

	protected function getDefaultLanguage()
	{
		return 0;
	}

	/**
	 * @return LanguageInterface
	 */
	protected function getLanguage()
	{
		if(!isset($this->language)) {
			$lang = $this->getSession()->get('user','lang');

			//wenn lang nicht in der Session ist
			if($lang === false) {
				$lang = $this->getCookie()->get($this->request,'lang');

				//wenn lang nicht im cookie ist
				if($lang === false) {
					$lang = $this->getDefaultLanguage();
				}
			}

			$this->language = new Language(ViewFactory::getLangPath(),$lang);
		}

		return $this->language;
	}

	/**
	 * Ändert die Sprache des users
	 *
	 * @param int $lang
	 * @param bool $cookie
	 */
	protected function changeLanguage(int $lang,bool $cookie = true)
	{
		$this->getLanguage()->changeLang($lang);

		$this->getSession()->set('user',['lang'=>$lang]);

		if($cookie) {
			$this->response = $this->getCookie()->set($this->response,'lang',$lang);
		}
	}
}