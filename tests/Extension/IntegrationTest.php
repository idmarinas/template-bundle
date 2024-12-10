<?php
/**
 * Copyright 2021-2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 29/11/24, 19:40
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    IntegrationTest.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Template\Tests\Extension;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Kernel;
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
		$kernel = new ExtensionTestingKernel();
		$kernel->boot();

		return $kernel->getContainer();
	}
}

class ExtensionTestingKernel extends Kernel
{
	public function __construct ()
	{
		parent::__construct('test', true);
	}

	public function registerBundles (): iterable
	{
		return [];
	}

	public function registerContainerConfiguration (LoaderInterface $loader): void {}
}
