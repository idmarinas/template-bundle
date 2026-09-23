<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 04/01/2026, 18:47
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

use Idm\Bundle\Template\IdmTemplateBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container, ContainerBuilder $builder) {
	$namespace = (new ReflectionClass(IdmTemplateBundle::class))->getNamespaceName();

	// @formatter:off
	$container
		->services()
			->load($namespace.'\\Tests\\Factory\\', $builder->getParameter('kernel.project_dir'). '/tests/Factory')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};
