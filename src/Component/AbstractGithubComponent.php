<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The AbstractGithubComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractGithubComponent extends AbstractComponent
{
	const REPO_USER = 0;
	const REPO_NAME = 1;
	const REPO_FULL = 2;

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = null;

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
	 * @param int $type
	 *
	 * @return string
	 */
	public function getRepository($type = self::REPO_FULL)
	{
		$repository = $this->repository;

		if ($type == static::REPO_NAME || $type == static::REPO_USER)
		{
			$repository = explode('/', $repository);

			if (count($repository) < 2)
			{
				throw new \LogicException('Repository name should be full name. example: user/repo');
			}

			return $repository[$type];
		}

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

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return $this->getRepository(static::REPO_NAME) . '-' . $this->getVersion();
	}
}
