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

use Gram\Mvc\Lib\Factories\ViewFactory;
use Gram\Middleware\Classes\ClassInterface;
use Gram\Middleware\Classes\ClassTrait;
use Gram\Project\Lib\Input;
use Gram\Project\Lib\View\View;

abstract class BaseController implements ClassInterface
{
	use ClassTrait, ControllerInputTrait, ControllerViewTrait;

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
			$this->view = new View(ViewFactory::getViewPath());
		}
	}
}