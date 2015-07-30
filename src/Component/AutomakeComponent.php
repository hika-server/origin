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
class AutomakeComponent extends AbstractComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'automake';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '1.9.2';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->addDependency(ComponentContainer::get('autoconf'));
	}

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'http://ftp.gnu.org/gnu/automake/automake-' . $this->getVersion() . '.tar.gz';
	}

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return 'automake-' . $this->getVersion();
	}

	/**
	 * postCompile
	 *
	 * @return  void
	 */
	protected function postCompile()
	{
		$files = array(
			'aclocal',
			'automake',
		);

		foreach ($files as $file)
		{
			if (!is_file('/usr/local/bin/' . $file))
			{
				symlink($this->getTargetPath() . '/bin/' . $file, '/usr/local/bin/' . $file);
			}
		}
	}
}
