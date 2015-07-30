<?php
/**
 * Part of hika project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The AutomakeComponent class.
 *
 * @since  {DEPLOY_VERSION}
 */
class AspellComponent extends AbstractComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'aspell';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '0.50.5';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
	}

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'http://ftp.gnu.org/gnu/aspell/aspell-' . $this->getVersion() . '.tar.gz';
	}

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return 'aspell-' . $this->getVersion();
	}
}
