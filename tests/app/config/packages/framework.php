<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/09/2026, 23:40
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    framework.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Mailer\Messenger\SendEmailMessage;

return static function (ContainerConfigurator $container): void {
	$container->extension('framework', [
		'secret'                => 'test',
		'http_method_override'  => false,
		'test'                  => true,
		'default_locale'        => 'en',
		'enabled_locales'       => ['en'],
		'handle_all_throwables' => true,
		'csrf_protection'       => [
			'enabled' => false,
		],
		'assets'                => [
			'enabled' => false,
		],
		'form'                  => [
			'enabled'         => false,
			'csrf_protection' => [
				'enabled' => true,
			],
		],
		'http_cache'            => [
			'enabled' => false,
			'debug'   => true,
		],
		'router'                => [
			'enabled' => true,
			'utf8'    => true,
		],
		'session'               => [
			'enabled'            => false,
			'handler_id'         => null,
			'cookie_secure'      => 'auto',
			'cookie_samesite'    => 'lax',
			'storage_factory_id' => 'session.storage.factory.mock_file',
		],
		'validation'            => [
			'enabled'                  => false,
			'email_validation_mode'    => 'html5',
			'not_compromised_password' => [
				'enabled' => false,
			],
		],
		'property_access'       => [
			'enabled' => false,
		],
		'php_errors'            => [
			'log' => true,
		],
		'messenger'             => [
			'enabled'    => false,
			'routing'    => [
				SendEmailMessage::class => [
					'senders' => ['sync'],
				],
			],
			'transports' => [
				'sync' => 'in-memory://',
			],
		],
		'mailer'                => [
			'enabled'  => false,
			'dsn'      => $_ENV['MAILER_DSN'] ?? 'null://null',
			'envelope' => [
				'sender' => 'idm_bundle@test.bundle',
			],
			'headers'  => [
				'From' => 'IDMarinas Template Bundle <idm_bundle@test.bundle>',
			],
		],
		'uid'                   => [
			'enabled'                 => false,
			'default_uuid_version'    => 7,
			'time_based_uuid_version' => 7,
		],
	]);
};
