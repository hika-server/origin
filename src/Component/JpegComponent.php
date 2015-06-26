<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The JpegComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class JpegComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'jpeg';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'LuaDist/libjpeg';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '8.4.0';
}
