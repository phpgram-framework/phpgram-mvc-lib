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
use Gram\Project\Lib\Input;

abstract class BaseController implements ClassInterface
{
	use ClassTrait, ControllerInputTrait, ControllerViewTrait;

	const ALTERNATIVE_SESSION = 1;

	protected function initInput()
	{
		if($this->input === null){
			$input = $this->request->getAttribute('InputClass',null);

			if($input===null){
				$this->input = new Input($this->request);
			}
		}
	}

	protected function initView()
	{
		if($this->view=== null){
			$this->view = ViewFactory::getView();
		}
	}

	protected function getSession()
	{
		//Wenn eine alternative Session verwendet werden soll
		if(getenv("ALTERNATIVE_SESSION")==self::ALTERNATIVE_SESSION) {
			return SessionFactory::getRequestSession($this->request);
		}

		return SessionFactory::getSession();
	}
}