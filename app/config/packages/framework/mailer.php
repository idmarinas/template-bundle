<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 30/12/2024, 17:53
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    mailer.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
	$container->extension('framework', [
		'mailer' => [
			'dsn'      => $_ENV['MAILER_DSN'] ?? 'null://null',
			'envelope' => [
				'sender' => 'idm_bundle@test.bundle',
			],
			'headers'  => [
				'From' => 'IDMarinas Template Bundle <idm_bundle@test.bundle>',
			],
		],
	]);
};
