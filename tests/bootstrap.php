<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/12/2024, 14:27
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    bootstrap.php
 * @date    10/12/2024
 * @time    14:05
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Idm\Bundle\Template\Tests\App\Kernel;
use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/vendor/autoload.php';

$kernel = new Kernel('test', true);
$filesystem = new Filesystem();

if ($filesystem->exists($kernel->getCacheDir())) {
	$filesystem->remove($kernel->getCacheDir());
}

if ($filesystem->exists($kernel->getLogDir())) {
	$filesystem->remove($kernel->getLogDir());
}
