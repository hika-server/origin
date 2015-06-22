<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The ZlibComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ZlibComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'zlib';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = 'v1.2.8';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'madler/zlib';
}
