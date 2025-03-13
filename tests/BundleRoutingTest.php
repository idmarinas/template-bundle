<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 22:09
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

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\RouterInterface;

class BundleRoutingTest extends KernelTestCase
{
	use KernelTestCaseTrait;

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
