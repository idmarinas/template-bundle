<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 23:27
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    IntegrationTest.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Template\Tests\Twig\Extension;

use App\Kernel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Test\IntegrationTestCase;

/**
 * Test Twig Extensions.
 *
 * @group ignore
 */
final class IntegrationTest extends IntegrationTestCase
{
	public static function getFixturesDirectory (): string
	{
		return __DIR__ . '/Fixtures/';
	}

	public function getExtensions (): array
	{
		return [];
	}

	protected function getContainer (): ContainerInterface
	{
		$kernel = new Kernel('test', true);
		$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
		$kernel->boot();

		return $kernel->getContainer();
	}
}
