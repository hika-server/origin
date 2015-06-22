<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Hika\Filesystem;

use Joomla\Archive\Archive;
use Joomla\Http\HttpFactory;
use Windwalker\Filesystem\Folder;

/**
 * The Downloader class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Downloader
{
	/**
	 * download
	 *
	 * @param string $url
	 * @param string $file
	 *
	 * @return  \Joomla\Http\Response
	 */
	public static function download($url, $file)
	{
		Folder::create(dirname($file));

		$handle = fopen($file, 'w+');

		$options = [
			'curl.transports' => [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FILE => $handle
			]
		];

		fclose($handle);

		$http = HttpFactory::getHttp($options);

		return $http->get($url);
	}

	/**
	 * extract
	 *
	 * @param string $file
	 * @param string $dest
	 *
	 * @return  boolean
	 */
	public static function extract($file, $dest)
	{
		Folder::create(HIKA_TEMP . '/tmp/archive');

		$options = array('tmp_path' => HIKA_TEMP . '/tmp/archive');

		$archive = new Archive($options);

		return $archive->extract($file, $dest);
	}
}
