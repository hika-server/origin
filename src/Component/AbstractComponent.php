<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

use Hika\Filesystem\Downloader;
use Hika\Ioc;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;

/**
 * The AbstractComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name;

	/**
	 * Property dependencies.
	 *
	 * @var  AbstractComponent[]
	 */
	protected $dependencies = [];

	/**
	 * Property io.
	 *
	 * @var  \Windwalker\Console\IO\IOInterface
	 */
	protected $io;

	/**
	 * Property process.
	 *
	 * @var  \Hika\Process\Process
	 */
	protected $process;

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version;

	/**
	 * Property config.
	 *
	 * @var  array
	 */
	protected $config = [];

	/**
	 * Property configureOptions.
	 *
	 * @var  array
	 */
	protected $configureOptions = [];

	/**
	 * Property prefix.
	 *
	 * @var  string
	 */
	protected $prefix;

	/**
	 * Property archive.
	 *
	 * @var  \SplFileInfo
	 */
	protected $archive;

	/**
	 * Property test.
	 *
	 * @var  boolean
	 */
	protected $test = false;

	/**
	 * Class init.
	 */
	public function __construct()
	{
		if (!$this->name)
		{
			$ref = new \ReflectionClass($this);

			$this->name = strtolower(substr($ref->getShortName(), -9));
		}

		if (!$this->name)
		{
			throw new \LogicException('Miss name of ' . __CLASS__);
		}

		$this->io = Ioc::getCurrentCommand()->getIO();
		$this->process = Ioc::getProcess();

		$this->initialise();
	}

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{

	}

	/**
	 * addDependency
	 *
	 * @param AbstractComponent $dep
	 *
	 * @return  static
	 */
	public function addDependency(AbstractComponent $dep)
	{
		$this->dependencies[$dep->getName()] = $dep;

		return $this;
	}

	/**
	 * Method to get property Name
	 *
	 * @return  string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * compile
	 *
	 * @return  void
	 */
	public function compile()
	{
		$this->compileDependencies();

		if ($this->test)
		{
			$this->out('This component is testing, will not run.');

			return;
		}

		$this->out('Build Conf.');
		$this->buildConf();

		$this->out('Configure.');
		$this->configure();

		$this->out('Make.');
		$this->make();

		$this->out('Make Install');
		$this->makeInstall();

		$this->out('Move to Library');
		$this->moveToLibrary();

		$this->out($this->getName() . ' build complete.');
	}

	/**
	 * download
	 *
	 * @param boolean $reset
	 *
	 * @return static
	 */
	public function download($reset = false)
	{
		$this->downloadDependencies($reset);

		if ($this->test)
		{
			$this->out('This component is testing, will not run.');

			return $this;
		}

		if (!$reset && is_dir($this->getPath()))
		{
			$this->out('Package exists.');

			return $this;
		}

		$this->out('Delete old files');

		if (is_dir($this->getPath()))
		{
			Folder::delete($this->getPath());
		}

		Folder::create($this->getPath());

		$this->out('Start download.');
		$this->doDownload();

		$this->out('Extract.');
		$this->extract();

		return $this;
	}

	/**
	 * download
	 *
	 * @return  \SplFileInfo
	 */
	public function doDownload()
	{
		$ext = File::getExtension($this->getDownloadUrl()) ? : 'zip';

		$dest = new \SplFileInfo($this->getArchivePath() . '/' . $this->getName() . '.' . $ext);

		Folder::create($dest->getPath());

		$this->execute(' wget ' . $this->getDownloadUrl() . ' -O ' . $dest->getPathname());

		$this->archive = $dest;

		return $this->archive;
	}

	/**
	 * extract
	 *
	 * @param bool $move
	 *
	 * @return string
	 */
	public function extract($move = true)
	{
		$dest = $this->getArchivePath() . '/' . $this->getName();

		Downloader::extract($this->archive->getPathname(), $dest);

		$this->execute('chmod -R +x ' . $dest);

		if ($move)
		{
			Folder::move($dest, $this->getSourcePath());
		}

		return $dest;
	}

	/**
	 * buildConf
	 *
	 * @return  static
	 */
	protected function buildConf()
	{
		$this->execute($this->getSourcePath() . '/buildconf --force');

		return $this;
	}

	/**
	 * configure
	 *
	 * @return  void
	 */
	protected function configure()
	{
		$command = 'cd ' . $this->getSourcePath() . ' && ./configure  --prefix=' . $this->getPrefix()
			. '  ' . $this->getConfigureOptions(true);

		$this->execute($command);
	}

	/**
	 * make
	 *
	 * @return  void
	 */
	protected function make()
	{
		$this->execute('make -C ' . $this->getSourcePath());
	}

	/**
	 * makeInstall
	 *
	 * @return  void
	 */
	protected function makeInstall()
	{
		$this->execute('make install -C ' . $this->getSourcePath());
	}

	/**
	 * moveToLibrary
	 *
	 * @return  void
	 */
	protected function moveToLibrary()
	{
		if (is_dir($this->getTargetPath()))
		{
			Folder::delete($this->getTargetPath());
		}

		Folder::create(dirname($this->getTargetPath()));

		Folder::move($this->getSourcePath(), $this->getTargetPath());

		$this->io->out('Moved to: ' . $this->getTargetPath());
	}

	/**
	 * getPrefix
	 *
	 * @return  string
	 */
	public function getPrefix()
	{
		return $this->getBuildPath();
	}

	/**
	 * getConfigureOptions
	 *
	 * @param bool $toString
	 *
	 * @return array|string
	 */
	public function getConfigureOptions($toString = false)
	{
		if ($toString)
		{
			return implode('  ', $this->configureOptions);
		}

		return $this->configureOptions;
	}

	/**
	 * getPath
	 *
	 * @return  string
	 */
	public function getPath()
	{
		return HIKA_TEMP . '/library/' . $this->getName();
	}

	/**
	 * getSourcePath
	 *
	 * @return  string
	 */
	public function getSourcePath()
	{
		return $this->getPath() . '/src';
	}

	/**
	 * getArchivePath
	 *
	 * @return  string
	 */
	public function getArchivePath()
	{
		return $this->getPath() . '/archive';
	}

	/**
	 * getBuildPath
	 *
	 * @return  string
	 */
	public function getBuildPath()
	{
		return $this->getPath() . '/usr';
	}

	/**
	 * getTargetPath
	 *
	 * @return  string
	 */
	public function getTargetPath()
	{
		return HIKA_USR . '/' . $this->getName();
	}

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return '';
	}

	/**
	 * compileDependencies
	 *
	 * @return  static
	 */
	protected function compileDependencies()
	{
		foreach ($this->dependencies as $dependency)
		{
			$dependency->compile();
		}

		return $this;
	}

	/**
	 * downloadDependencies
	 *
	 * @param bool $reset
	 *
	 * @return static
	 */
	protected function downloadDependencies($reset = false)
	{
		foreach ($this->dependencies as $dependency)
		{
			$dependency->download($reset);
		}

		return $this;
	}

	/**
	 * Method to get property Version
	 *
	 * @return  string
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * Method to set property version
	 *
	 * @param   string $version
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setVersion($version)
	{
		$this->version = $version;

		return $this;
	}

	/**
	 * execute
	 *
	 * @param string $command
	 *
	 * @return  static
	 */
	public function execute($command)
	{
		return $this->process->execute($command);
	}

	/**
	 * out
	 *
	 * @param string  $text
	 * @param bool    $nl
	 *
	 * @return  static
	 */
	public function out($text, $nl = true)
	{
		$prefix = sprintf('[%s - %s] ', $this->getName(), $this->getVersion());

		$this->io->out()->out('<comment>' . $prefix . $text . '</comment>', $nl);

		return $this;
	}
}
