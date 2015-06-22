<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika;

use Hika;
use Joomla\Http\Http;
use Windwalker\Console\Command\Command;
use Windwalker\Console\IO\IO;
use Windwalker\DI\Container;

/**
 * The Ioc class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Ioc
{
	/**
	 * Property instance.
	 *
	 * @var  Container
	 */
	protected static $instance;

	/**
	 * getApplication
	 *
	 * @return  Application\Application
	 */
	public static function getApplication()
	{
		return static::get('app');
	}

	/**
	 * getIO
	 *
	 * @return IO
	 */
	public static function getIO()
	{
		return static::get('io');
	}

	/**
	 * getProcess
	 *
	 * @return  Process\Process
	 */
	public static function getProcess()
	{
		return static::get('process');
	}

	/**
	 * getCurrentCommand
	 *
	 * @return  Command
	 */
	public static function getCurrentCommand()
	{
		return static::get('current.command');
	}

	/**
	 * getHttp
	 *
	 * @return  Http
	 */
	public static function getHttp()
	{
		return static::get('http');
	}

	/**
	 * get
	 *
	 * @param string $key
	 *
	 * @return  mixed
	 */
	public static function get($key)
	{
		$container = static::factory();

		if (!$container->exists($key))
		{
			return null;
		}

		return $container->get($key);
	}

	/**
	 * share
	 *
	 * @param string $key
	 * @param mixed  $data
	 *
	 * @return  void
	 */
	public static function share($key, $data)
	{
		static::factory()->share($key, $data);
	}

	/**
	 * factory
	 *
	 * @return  Container
	 */
	public static function factory()
	{
		if (!static::$instance)
		{
			static::$instance = new Container;
		}

		return static::$instance;
	}

	/**
	 * setInstance
	 *
	 * @param Container $instance
	 *
	 * @return  void
	 */
	public static function setInstance(Container $instance)
	{
		static::$instance = $instance;
	}
}
