<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/09/2026, 23:42
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

use Idm\Bundle\Template\IdmTemplateBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container, ContainerBuilder $builder): void {
	$namespace = (new ReflectionClass(IdmTemplateBundle::class))->getNamespaceName();

	// @formatter:off
	$container
		->services()
			->load($namespace.'\\Tests\\DataFixtures\\', $builder->getParameter('kernel.project_dir') . '/tests/DataFixtures')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};
