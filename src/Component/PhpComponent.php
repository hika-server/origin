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
	protected $version = 'php-7.0.0alpha1';

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
		$this->addDependency(new AutoconfComponent)
			->addDependency(new BisonComponent)
			->addDependency(new ZlibComponent);

		$this->config['compile.again'] = true;
	}

	/**
	 * getAliasPrepare
	 *
	 * @return  array
	 */
	public function getAliasPrepare()
	{
		return [
			'export PHP_AUTOCONF=' . $this->getDependency('autoconf')->getTargetPath() . '/bin/autoconf',
			'alias bison=' . $this->getDependency('bison')->getTargetPath() . '/bin/bison'
		];
	}
}
