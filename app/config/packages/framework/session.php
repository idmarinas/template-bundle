<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 30/12/2024, 17:53
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    session.php
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
		'session' => [
			'handler_id'         => null,
			'cookie_secure'      => true,
			'cookie_samesite'    => 'lax',
			'storage_factory_id' => 'session.storage.factory.mock_file',
		],
	]);
};
