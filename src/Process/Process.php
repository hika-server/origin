<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Process;

use Windwalker\Console\IO\IOInterface;

/**
 * The Process class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Process
{
	const MUTE = true;

	/**
	 * Property io.
	 *
	 * @var  IOInterface
	 */
	protected $io;

	/**
	 * Property lastOutput.
	 *
	 * @var  string
	 */
	protected $lastOutput;

	/**
	 * Property lastCommand.
	 *
	 * @var  string
	 */
	protected $lastCommand;

	/**
	 * Class init.
	 *
	 * @param IOInterface $io
	 */
	public function __construct(IOInterface $io)
	{
		$this->io = $io;
	}

	/**
	 * execute
	 *
	 * @param string $command
	 *
	 * @return  static
	 */
	public function execute($command, $mute = true)
	{
		$this->lastCommand = $command;

		if ($mute)
		{
			$this->io->out()->out('>> <info>' . $command . '</info>');

			// $this->io->out($this->lastOutput = exec($command));
		}

		system($command, $this->lastOutput);

		return $this;
	}

	/**
	 * Method to get property LastOutput
	 *
	 * @return  string
	 */
	public function getLastOutput()
	{
		return $this->lastOutput;
	}

	/**
	 * Method to get property LastCommand
	 *
	 * @return  string
	 */
	public function getLastCommand()
	{
		return $this->lastCommand;
	}
}
