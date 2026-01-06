<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/01/2026, 14:32
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    fixtures.php
 * @date    20/12/2024
 * @time    17:49
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container, ContainerBuilder $builder) {
	// @formatter:off
	$container
		->services()
			->load('DataFixtures\\', $builder->getParameter('kernel.project_dir') . '/tests/DataFixtures')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};
