<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

use Windwalker\Filesystem\Folder;

/**
 * The AbstractGithubComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractGithubComponent extends AbstractComponent
{
	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = null;

	/**
	 * extract
	 *
	 * @return  string
	 */
	public function extract()
	{
		$dest = parent::extract(false);

		$newDest = $dest . '/' . $this->getName() . '-' . $this->getVersion();

		if (!is_dir($newDest))
		{
			// Remove v
			$newDest = $dest . '/' . $this->getName() . '-' . substr($this->getVersion(), 1);
		}

		Folder::move($newDest, $this->getSourcePath());

		return $newDest;
	}

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'https://github.com/' . $this->getRepository() . '/archive/' . $this->getVersion() . '.zip';
	}

	/**
	 * Method to get property Repository
	 *
	 * @return  string
	 */
	public function getRepository()
	{
		return $this->repository ? : $this->getName();
	}

	/**
	 * Method to set property repository
	 *
	 * @param   string $repository
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setRepository($repository)
	{
		$this->repository = $repository;

		return $this;
	}
}
