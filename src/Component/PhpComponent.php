<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

use Windwalker\Filesystem\File;
use Windwalker\String\StringHelper;

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
		$this->addDependency(ComponentContainer::get('autoconf'))
			->addDependency(new BisonComponent)
			->addDependency(new JpegComponent)
			->addDependency(new PngComponent)
			->addDependency(new FreetypeComponent)
			->addDependency(new ZlibComponent)
		;

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
			'export PHP_AUTOCONF=' . $this->getDependency('autoconf')->getTargetPath() . '/bin/autoconf'
		];
	}

	/**
	 * preCompile
	 *
	 * @return  void
	 */
	protected function preCompile()
	{
		// Set Bison link to /usr/local/bin
		if (is_file('/usr/local/bin/bison'))
		{
			if (is_file('/usr/local/bin/bison.bak'))
			{
				return;
			}

			File::move('/usr/local/bin/bison', '/usr/local/bin/bison.bak');
		}

		symlink($this->getDependency('bison')->getTargetPath() . '/bin/bison', '/usr/local/bin/bison');
	}

	/**
	 * postCompile
	 *
	 * @return  void
	 */
	protected function postCompile()
	{
		File::delete('/usr/local/bin/bison');

		// Restore
		if (is_file('/usr/local/bin/bison.bak'))
		{
			File::move('/usr/local/bin/bison.bak', '/usr/local/bin/bison');
		}
	}

	/**
	 * Class close.
	 */
	public function __destruct()
	{

	}

	/**
	 * getConfigureOptions
	 *
	 * @param bool  $toString
	 * @param array $options
	 *
	 * @return  array|string
	 */
	public function getConfigureOptions($toString = false, $options = [])
	{
		$options = [
			'--with-config-file-path=' . $this->getTargetPath() . '/etc',
			'--enable-zip',
			'--enable-mbstring',
			'--enable-bcmath',
			'--enable-pcntl',
			'--enable-ftp',
			'--enable-exif',
			'--enable-calendar',
			'--enable-sysvmsg',
			'--enable-sysvsem',
			'--enable-sysvshm',
			'--enable-wddx',
			'--with-curl',
			'--with-mcrypt',
			'--with-iconv',
			'--with-gmp',
			'--with-pspell',
			'--with-gd',
			'--with-jpeg-dir=' . $this->getDependency('jpeg')->getTargetPath(),
			'--with-png-dir=' . $this->getDependency('png')->getTargetPath(),
			'--with-zlib-dir=' . $this->getDependency('zlib')->getTargetPath(),
			'--with-freetype-dir=' . $this->getDependency('freetype')->getTargetPath(),
		];

		return parent::getConfigureOptions($toString, $options);
	}
}
