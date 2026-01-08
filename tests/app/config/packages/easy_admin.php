<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/01/2026, 21:02
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    easy_admin.php
 * @date    23/03/2025
 * @time    21:18
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
	$container->extension('framework', [
		'form'   => true,
		'assets' => true,
		'router' => [
			'enabled' => true,
			'utf8'    => true,
		],
	]);
};
