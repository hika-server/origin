<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The PhpComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PhpComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'php';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = 'php-5.3.29';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'php/php-src';

	/**
	 * Property test.
	 *
	 * @var  bool
	 */
	protected $test = false;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->addDependency(new ZlibComponent);
	}
}