<?php
/**
 * Part of hika project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

include_once __DIR__ . '/etc/defines.php';

include_once HIKA_VENDOR . '/autoload.php';

$app = new \Hika\Application\Application;

$app->addCommand(new \Hika\Command\DownloadCommand);
$app->addCommand(new \Hika\Command\BuildCommand);

$app->execute();
