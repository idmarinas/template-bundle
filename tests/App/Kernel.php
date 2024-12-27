<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/12/2024, 14:43
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    Kernel.php
 * @date    10/12/2024
 * @time    14:27
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Template\Tests\App;

use DAMA\DoctrineTestBundle\DAMADoctrineTestBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Exception;
use Idm\Bundle\Template\IdmTemplateBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Zenstruck\Foundry\ZenstruckFoundryBundle;

final class Kernel extends BaseKernel
{
	use MicroKernelTrait;

	/**
	 * @inheritDoc
	 */
	public function registerBundles (): iterable
	{
		yield from parent::getBundles();

		yield new FrameworkBundle();
		yield new IdmTemplateBundle();
		yield new DoctrineBundle();

		// Dev-Test Bundles
		yield new DAMADoctrineTestBundle();
		yield new DoctrineFixturesBundle();
		yield new ZenstruckFoundryBundle();
	}

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function registerContainerConfiguration (LoaderInterface $loader): void
	{
		$loader->load($this->getProjectDir() . '/tests/config/framework.php');
		$loader->load($this->getProjectDir() . '/tests/config/doctrine.php');

		$loader->load($this->getConfigDir() . '/factories.php');
		$loader->load($this->getConfigDir() . '/fixtures.php');

		$loader->load(function (ContainerBuilder $container) use ($loader) {
			$container
				->register('kernel', static::class)
				->setPublic(true)
			;

			$kernelDefinition = $container->getDefinition('kernel');
			$kernelDefinition->addTag('routing.route_loader');
		});
	}

	public function configureRoutes (RoutingConfigurator $routes): void
	{
		$routes->import($this->getConfigDir() . '/routes.php');

		$routes->add('app_home', '/')->methods(['GET']);
	}
}
