<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/11/2025, 17:31
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
			->load('DataFixtures\\', $builder->getParameter('kernel.project_dir') . '/fixtures')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};
