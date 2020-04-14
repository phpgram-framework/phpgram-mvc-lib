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

/**
 * Class ConsoleController
 * @package Gram\Mvc\Lib\Controller\Console
 *
 * Controller der Console Input unterstüzt
 */
abstract class ConsoleController extends BaseController
{
	/** @var array */
	protected $attributes;

	/** @var array */
	protected $args;

	/**
	 * Hole ein Attribute aus dem Request
	 *
	 * @param string $name
	 * @param null $default
	 * @return mixed
	 */
	protected function getAttribute(string $name, $default = null)
	{
		if(!isset($this->attributes[$name])) {
			$this->attributes[$name] = $this->request->getAttribute($name,$default);
		}

		return $this->attributes[$name];
	}

	/**
	 * Hole für ein gegebens argument den Content
	 *
	 * Args kommen aus dem Pr 7 Request
	 *
	 * @param $arg
	 * Gibt die jeweilige Stelle an z. B. Arg 0
	 *
	 * @return mixed
	 */
	protected function getArg($arg)
	{
		if(!isset($this->args[$arg])) {
			$this->args[$arg] = $this->getAttribute('args')[$arg] ?? false;
		}

		return $this->args[$arg];
	}
}