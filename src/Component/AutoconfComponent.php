<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The AutoconfComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AutoconfComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'autoconf';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = 'AUTOCONF-2.59';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'kergoth/autoconf';
}
