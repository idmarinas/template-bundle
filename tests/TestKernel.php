<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 20/12/2024, 17:45
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    TestKernel.php
 * @date    10/12/2024
 * @time    14:27
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Template\Tests;

use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Idm\Bundle\Template\IdmTemplateBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Zenstruck\Foundry\ZenstruckFoundryBundle;

final class TestKernel extends Kernel
{
	use MicroKernelTrait;

	/**
	 * @inheritDoc
	 */
	public function registerBundles (): iterable
	{
		yield new FrameworkBundle();
		yield new IdmTemplateBundle();

		// Dev-Test Bundles
		yield new DoctrineFixturesBundle();
		yield new ZenstruckFoundryBundle();
	}

	/**
	 * @inheritDoc
	 */
	public function registerContainerConfiguration (LoaderInterface $loader): void
	{
		$loader->load(function (ContainerBuilder $container) use ($loader) {
			$container->loadFromExtension('framework', [
				'test'       => true,
				'router'     => [
					'resource'  => 'kernel::loadRoutes',
					'type'      => 'service',
					'utf8'      => true,
					'cache_dir' => $this->getCacheDir(),
				],
				'secret'     => 'test',
				'form'       => false,
				'validation' => false,
				'mailer'     => false,
				'session'    => [
					'storage_factory_id' => 'session.storage.factory.mock_file',
				],
			]);

//			// Uncomment for activate Doctrine
//			$container->loadFromExtension('doctrine', [
//				'dbal' => [
//					'driver' => 'pdo_sqlite',
//					'url'    => sprintf('sqlite:///%s/idm_user_%s.sqlite', $this->getDatabaseCache(), $this->environment),
//				],
//				'orm'  => [
//					'enable_lazy_ghost_objects'   => true,
//					'auto_generate_proxy_classes' => true,
//					'auto_mapping'                => false,
//					'mappings'                    => [
//						'IdmTestBundle' => [
//							'mapping' => true,
//							'type'    => 'attribute',
//							'dir'     => __DIR__ . '/Fixtures/Entity',
//							'prefix'  => 'Idm\Bundle\Template\Tests\Fixtures\Entity',
//						],
//					],
//					'resolve_target_entities' => [
//						AbstractEntity::class => Entity::class,
//					],
//				],
//			]);

			$container
				->register('kernel', static::class)
				->setPublic(true)
			;

			$kernelDefinition = $container->getDefinition('kernel');
			$kernelDefinition->addTag('routing.route_loader');

			$loader->load($this->getConfigDir() . '/factories.php');
			$loader->load($this->getConfigDir() . '/fixtures.php');
		});
	}

	public function configureRoutes (RoutingConfigurator $routes): void
	{
		$routes->import($this->getConfigDir() . '/routes.php');

		$routes->add('app_home', '/')->methods(['GET']);
	}

	public function getDatabaseCache (): string
	{
		$dir = $this->getProjectDir() . '/var/cache/database';

		$filesystem = new Filesystem();

		if (!$filesystem->exists($dir)) {
			$filesystem->mkdir($dir);
		}

		return $dir;
	}
}
