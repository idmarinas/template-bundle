<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "idmarinas" on 17/06/2025, 17:12
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    doctrine.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Template\IdmTemplateBundle;
use ReflectionClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Filesystem\Filesystem;
use function Symfony\Component\String\u;

return static function (ContainerConfigurator $container, ContainerBuilder $builder) {
	$getDatabaseCache = function (string $projectDir, string $env): string {
		$dir = $projectDir . '/var/cache/database';

		$filesystem = new Filesystem();

		if (!$filesystem->exists($dir)) {
			$filesystem->mkdir($dir);
		}

		$dbName = (new ReflectionClass(IdmTemplateBundle::class))->getShortName();
		$dbName = u($dbName)->snake()->toString();

		return sprintf('sqlite:///%s/%s_%s.sqlite', $dir, $dbName, $env);
	};

	$container->extension('doctrine', [
		'dbal' => [
			'driver'         => 'pdo_sqlite',
			'url'            => $getDatabaseCache($builder->getParameter('kernel.project_dir'), $container->env()),
			'use_savepoints' => true,
		],
		'orm'  => [
			'enable_lazy_ghost_objects'   => true,
			'auto_generate_proxy_classes' => true,
			'auto_mapping'                => false,
			'controller_resolver'         => [
				'auto_mapping' => false,
			],
			'mappings'                    => [
				'Tests' => [
					'is_bundle' => false,
					'mapping'   => true,
					'type'      => 'attribute',
					'dir'       => dirname(__DIR__, 2) . '/src/Entity',
					'prefix'    => 'App\Entity',
				],
			],
			//'resolve_target_entities' => [
			//	AbstractUser::class => User::class,
			//],
		],
	]);
};
