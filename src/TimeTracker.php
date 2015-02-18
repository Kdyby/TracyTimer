<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2015 Martin Štekl (martin.stekl@gmail.com)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Kdyby\TracyTimer;

use Nette\Object;



/**
 * @author Martin Štekl <martin.stekl@gmail.com>
 */
class TimeTracker extends Object
{

	/**
	 * @var array[]
	 */
	private static $times = [];



	/**
	 * Tracks given timestamp (or current if NULL value provided) under given label.
	 *
	 * @param string $label
	 * @param float|NULL $time
	 */
	public static function trackTime($label, $time = NULL)
	{
		self::$times[] = [
			'label' => $label,
			'time' => $time ?: microtime(TRUE)
		];
	}



	/**
	 * @return array[]
	 */
	public static function getTimes()
	{
		return self::$times;
	}

}
