<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Application;

use Hika\Ioc;
use Windwalker\Console\Console;
use Windwalker\DI\Container;
use Windwalker\DI\ContainerAwareInterface;
use Windwalker\DI\ContainerAwareTrait;
use Windwalker\Registry\Registry;

/**
 * The Application class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Application extends Console implements ContainerAwareInterface
{
	use ContainerAwareTrait;

	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'hike-builder';

	/**
	 * Property description.
	 *
	 * @var  string
	 */
	protected $description = 'Hikari Server Builder.';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->container = Ioc::factory();

		$this->container->share('config', $this->loadConfig($this->config));

		$this->loadProviders();
	}

	/**
	 * loadProviders
	 *
	 * @return  void
	 */
	protected function loadProviders()
	{

	}

	/**
	 * loadConfig
	 *
	 * @param Registry $config
	 *
	 * @return  Registry
	 */
	protected function loadConfig(Registry $config)
	{
		$config->loadFile(HIKA_ETC . '/config.yml', 'yaml');

		return $config;
	}
}
