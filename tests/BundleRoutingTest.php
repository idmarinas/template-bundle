<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 03/01/2025, 20:37
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    BundleRoutingTest.php
 * @date    03/01/2025
 * @time    20:37
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Template\Tests;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

class BundleRoutingTest extends KernelTestCase
{
	protected static function createKernel (array $options = []): KernelInterface
	{
		/**
		 * @var Kernel $kernel
		 */
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}

	public function testAddRoutingFile (): void
	{
		$kernel = self::bootKernel();

		$container = $kernel->getContainer();
		$container = $container->get('test.service_container');
		/**
		 * @var RouterInterface $router
		 */
		$router = $container->get(RouterInterface::class);
		$routeCollection = $router->getRouteCollection();
		$routes = $routeCollection->all();

		$this->assertCount(1, $routes);
		$this->assertNotNull($routeCollection->get('app_home'));
	}
}
