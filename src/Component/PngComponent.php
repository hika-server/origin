<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The PngComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PngComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'png';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'hika-server/libpng';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = 'v1.4.14';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->addDependency(ComponentContainer::get('automake'));
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

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return $this->getRepository($this::REPO_NAME) . '-' . trim($this->getVersion(), 'v');
	}
}
