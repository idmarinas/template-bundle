<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "idmarinas" on 10/03/2025, 13:42
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    framework.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $config) {
	$config
		->secret('test')
		->test(true)
		->httpMethodOverride(false)
		->handleAllThrowables(true)
	;
	$config->form()->enabled(false);
	$config->propertyAccess()->enabled(true);
	$config->phpErrors()->log(true);
};
