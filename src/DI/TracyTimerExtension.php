<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2015 Martin Štekl (martin.stekl@gmail.com)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Kdyby\TracyTimer\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator as Code;



/**
 * @author Martin Štekl <martin.stekl@gmail.com>
 */
class TracyTimerExtension extends CompilerExtension
{

	public function beforeCompile()
	{
		parent::beforeCompile();

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('panel'))
			->setClass('Kdyby\TracyTimer\Panel');
	}



	public function afterCompile(Code\ClassType $class)
	{
		parent::afterCompile($class);

		$init = $class->addMethod('_kdyby_initialize_tracy_timer');
		$init->setVisibility('protected');
		$init->addBody('Tracy\Debugger::getBar()->addPanel($this->getService(?));', [
			$this->prefix('panel'),
		]);

		$class->methods['initialize']->addBody('$this->_kdyby_initialize_tracy_timer();');
	}

}
