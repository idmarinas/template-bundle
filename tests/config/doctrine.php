<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/12/2024, 14:39
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    doctrine.php
 * @date    27/12/2024
 * @time    14:41
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Filesystem\Filesystem;

return static function (ContainerConfigurator $container) {
	$getDatabaseCache = function (): string {
		$dir = dirname(__DIR__, 2) . '/var/cache/database';

		$filesystem = new Filesystem();

		if (!$filesystem->exists($dir)) {
			$filesystem->mkdir($dir);
		}

		return $dir;
	};

	$container->extension('doctrine', [
		'dbal' => [
			'driver'         => 'pdo_sqlite',
			'url'            => sprintf('sqlite:///%s/idm_bundle_%s.sqlite', $getDatabaseCache(), $container->env()),
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
					'dir'       => dirname(__DIR__) . '/App/Entity',
					'prefix'    => 'Idm\Bundle\Template\Tests\App\Entity',
				],
			],
			//'resolve_target_entities' => [
			//	AbstractUser::class => User::class,
			//],
		],
	]);
};
