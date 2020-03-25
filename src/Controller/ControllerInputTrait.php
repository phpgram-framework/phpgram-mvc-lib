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

use Gram\Project\Lib\Input;

/**
 * Trait ControllerInputTrait
 * @package Gram\Project\Lib\Controller
 *
 * Input Erweiterung
 */
trait ControllerInputTrait
{
	/** @var Input */
	protected $input;

	abstract protected function getInputClass(): Input;

	/**
	 * Gibt zu einem geg. Index (kann auch ein Array sein)
	 * den passenden Inputwert zurück
	 *
	 * @param $name
	 * @param bool $clean
	 * @return mixed
	 */
	protected function getInput($name,$clean = true)
	{
		return $this->getInputClass()->get($name,$clean);
	}

	/**
	 * @param $name
	 * @param bool $strict
	 * @param bool $clean
	 * @return mixed|bool
	 */
	protected function gNcInput($name, $strict = true, $clean = true)
	{
		return $this->getInputClass()->gNc($name,$strict,$clean);
	}
}