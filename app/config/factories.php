<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 31/01/2025, 19:08
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    factories.php
 * @date    20/12/2024
 * @time    17:49
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
	// @formatter:off
	$container
		->services()
			->load('Factory\\', dirname(__DIR__, 2) . '/factories')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};
