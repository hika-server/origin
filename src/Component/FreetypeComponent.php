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
class FreetypeComponent extends AbstractGithubComponent
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'freetype';

	/**
	 * Property repository.
	 *
	 * @var  string
	 */
	protected $repository = 'asika32764/freetype2';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = 'VER-2-6';

	/**
	 * getDownloadUrl
	 *
	 * @return  string
	 */
	public function getDownloadUrl()
	{
		return 'https://github.com/asika32764/freetype2/releases/download/' . $this->getVersion() . '/' . $this->getVersion() . '.zip';
	}

	/**
	 * getExtractedPath
	 *
	 * @return  string
	 */
	public function getExtractedPath()
	{
		return '';
	}
}
