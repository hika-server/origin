<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Command;

use Hika\Ioc;
use Hika\Process\Process;
use Windwalker\Console\Command\Command;

/**
 * The AbstractCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractCommand extends Command
{
	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		Ioc::share('current.command', $this);
		Ioc::share('io', $this->getIO());
		Ioc::share('process', new Process($this->getIO()));
	}
}
