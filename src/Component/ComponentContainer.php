<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

use Hika\Ioc;

/**
 * The ComponentContainer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ComponentContainer
{
	/**
	 * get
	 *
	 * @param string $name
	 *
	 * @return  AbstractComponent
	 */
	public static function get($name)
	{
		$key = 'component.' . $name;

		$container = static::getContainer();

		if (!$container->exists($key))
		{
			$class = 'Hika\Component\\' . ucfirst($name) . 'Component';

			$container->share($key, new $class);
		}

		return $container->get($key);
	}

	/**
	 * getContainer
	 *
	 * @return  \Windwalker\DI\Container
	 */
	public function getContainer()
	{
		return Ioc::factory();
	}
}
