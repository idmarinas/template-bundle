<?php
/**
 * Copyright 2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/12/2024, 14:27
 *
 * @project Idm Template Bundle
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

use Idm\Bundle\Template\IdmTemplateBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class BaseKernel extends Kernel
{
	use MicroKernelTrait;
}

final class TestKernel extends BaseKernel
{
	/**
	 * @inheritDoc
	 */
	public function registerBundles (): iterable
	{
		yield new FrameworkBundle();
		yield new IdmTemplateBundle();
	}

	/**
	 * @inheritDoc
	 */
	public function registerContainerConfiguration (LoaderInterface $loader): void
	{
		parent::registerContainerConfiguration($loader);

		$loader->load(function (ContainerBuilder $container) use ($loader) {
			$container->loadFromExtension('framework', [
				'test'       => true,
				'router'     => [
					'utf8'      => true,
					'cache_dir' => $this->getCacheDir(),
				],
				'secret'     => 'test',
				'form'       => false,
				'validation' => false,
				'mailer'     => false,
			]);
		});
	}

	public function configureRoutes (RoutingConfigurator $routes): void
	{
		$routes->add('app_home', '/')->methods(['GET']);
	}
}
