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
use Tracy\Debugger;
use Tracy\IBarPanel;



/**
 * @author Martin Štekl <martin.stekl@gmail.com>
 */
class Panel extends Object implements IBarPanel
{

	/**
	 * @return string
	 */
	public function getTab()
	{
		$time = microtime(TRUE) - Debugger::$time;

		return '<span title="TracyTimer">' . $this->formatTime($time) . '</span>';
	}



	/**
	 * @return string
	 */
	public function getPanel()
	{
		$times = TimeTracker::getTimes();
		if (!$times) {
			return '';
		}

		$panel = '
			<div class="nette-inner tracy-inner nette-tracyTimerPanel">
			<table>
				<tr>
					<th>Label</th>
					<th>Time</th>
					<th>Duration</th>
					<th>Duration per label</th>
				</tr>
		';

		$lastGlobal = NULL;
		$lastByLabels = [];
		foreach ($times as $entry) {
			$label = $entry['label'];
			$time = $entry['time'];

			$panel .= '<tr>
				<th>' . $label . '</th>
				<td style="text-align: right;">' . $this->formatTime($time - Debugger::$time) . '</td>
				<td style="text-align: right;">' . $this->formatTime($lastGlobal === NULL ? 0.0 : ($time - $lastGlobal)) . '</td>
				<td style="text-align: right;">' . $this->formatTime(!array_key_exists($label, $lastByLabels) ? 0.0 : ($time - $lastByLabels[$label])) . '</td>
			</tr>';

			$lastGlobal = $time;
			$lastByLabels[$label] = $time;
		}

		return $panel . '</table></div>';
	}



	/**
	 * @param float $time
	 * @return string
	 */
	private function formatTime($time)
	{
		return number_format($time * 1000, 1, '.', '&nbsp;') . '&nbsp;ms';
	}

}
