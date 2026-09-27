<?php
/**
 * Copyright 2026-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/09/2026, 23:53
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    zenstruck_foundry.php
 * @date    27/09/2026
 * @time    20:16
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use const PHP_VERSION_ID;

return static function (ContainerConfigurator $container): void {
	$config = [
		'persistence' => [
			'flush_once' => true,
		],
	];

	// Foundry only deprecates the unset value from PHP 8.4 on, and refuses to
	// enable it below that, so the option must stay absent on older runtimes.
	if (PHP_VERSION_ID >= 80400) {
		$config['enable_auto_refresh_with_lazy_objects'] = true;
	}

	$container->extension('zenstruck_foundry', $config);
};
