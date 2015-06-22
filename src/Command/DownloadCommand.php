<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Command;

use Hika\Component\PhpComponent;

/**
 * The DownloadCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DownloadCommand extends AbstractCommand
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->setName('download')
			->description('Download all dependency');

		$this->addOption('r')
			->alias('reset')
			->description('Delete old files.')
			->defaultValue(0);
	}

	/**
	 * doExecute
	 *
	 * @return  bool
	 */
	protected function doExecute()
	{
		$com = new PhpComponent;

		$com->download((bool) $this->getOption('r', 0));

		return true;
	}
}
