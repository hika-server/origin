<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The BisonComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BisonComponent extends AbstractComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'bison';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '2.6.4';

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'http://ftp.gnu.org/gnu/bison/bison-' . $this->getVersion() . '.tar.gz';
	}
}
