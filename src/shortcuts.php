<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2015 Martin Štekl (martin.stekl@gmail.com)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

use Kdyby\TracyTimer\TimeTracker;


if (!function_exists('timer')) {

	/**
	 * Tracks given timestamp (or current if NULL value provided) under given label.
	 *
	 * @param string $label
	 * @param float|NULL $time
	 */
	function timer($label, $time = NULL)
	{
		TimeTracker::trackTime($label, $time);
	}

}
