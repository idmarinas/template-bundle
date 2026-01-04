<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/11/2025, 16:08
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    web_profiler.php
 * @date    07/11/2025
 * @time    14:55
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
	if ('dev' === $container->env()) {
		$container->extension('web_profiler', [
			'toolbar' => true,
		]);

		$container->extension('framework', [
			'profiler' => [
				'collect_serializer_data' => true,
			],
		]);
	}

	if ('test' === $container->env()) {
		$container->extension('web_profiler', [
			'toolbar' => false,
		]);
		$container->extension('framework', [
			'profiler' => [
				'collect'                 => false,
				'collect_serializer_data' => true,
			],
		]);
	}
};
