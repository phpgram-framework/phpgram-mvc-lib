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

use Gram\Project\Lib\View\ViewInterface;

/**
 * Trait ControllerViewTrait
 * @package Gram\Project\Lib\Controller
 *
 * View Erweiterung
 */
trait ControllerViewTrait
{
	/** @var ViewInterface */
	protected $view;

	abstract protected function initView();

	/**
	 * @param $tpl
	 * @param array $vars
	 * @return ViewInterface
	 */
	protected function view($tpl,array $vars=[])
	{
		$this->initView();

		return $this->view->view($tpl,$vars);
	}
}