<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Command;

use Hika\Component;

/**
 * The BuildCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BuildCommand extends AbstractCommand
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->setName('build')
			->description('Build this package.');
	}

	/**
	 * doExecute
	 *
	 * @return  boolean
	 */
	protected function doExecute()
	{
		$com = new Component\PhpComponent;

		$com->compile();

		return true;
	}
}
