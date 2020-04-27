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

use Gram\Project\Lib\DB\DBInterface;
use Gram\Project\Lib\DB\StdDB;

class DB
{
	/** @var DBInterface */
	private static $_instance=null;

	/**
	 * @param bool $new
	 * @return DBInterface
	 */
	public static function db(bool $new = false)
	{
		if(!isset(self::$_instance) || $new){
			self::$_instance = new StdDB(
				getenv("DB_DRIVER"),
				getenv("DB_HOST"),
				getenv("DB_PORT"),
				getenv("DB_NAME"),
				getenv("DB_USER"),
				getenv("DB_USER_PW")
			);
		}

		return self::$_instance;
	}
}