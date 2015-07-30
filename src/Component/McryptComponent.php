<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Component;

/**
 * The PngComponent class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class McryptComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'mcrypt';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'hika-server/libmcrypt';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '2.5.7';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
	}
}
