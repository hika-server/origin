<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The GmpComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GmpComponent extends AbstractComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'gmp';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '5.0.2';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		// $this->addDependency(ComponentContainer::get('automake'));
	}

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'http://ftp.gnu.org/gnu/gmp/gmp-' . $this->getVersion() . '.tar.gz';
	}

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return $this->getName() . '-' . $this->getVersion();
	}

	/**
	 * configure
	 *
	 * @return  void
	 */
	protected function configure()
	{
		// $command = ' cd ' . $this->getSourcePath() . ' && ' . $this->getSourcePath() . '/autogen.sh';

		// $this->execute($command);

		parent::configure();
	}

//	/**
//	 * getExtractedPath
//	 *
//	 * @return  string
//	 */
//	public function getExtractedPath()
//	{
//		return $this->getRepository($this::REPO_NAME) . '-' . trim($this->getVersion(), 'v');
//	}
}
