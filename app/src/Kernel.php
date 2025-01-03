<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 03/01/2025, 19:25
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    Kernel.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace App;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
	use MicroKernelTrait;

	private array $extraBundles = [];
	private array $extraRoutes  = [];
	private array $extraConfig  = [];

	public function configureRoutes (RoutingConfigurator $routes): void
	{
		$routes->import($this->getConfigDir() . '/routes.php');
//		$routes->import('security.route_loader.logout', 'service')->methods(['GET']);

		$extraRoutes = array_unique($this->extraRoutes);

		foreach ($extraRoutes as $route) {
			$routes->import($route);
		}

		$routes
			->add('app_home', '/')
			->methods(['GET'])
			->controller(TemplateController::class)
			//->defaults([
			//	'template' => 'path/to/template.html.twig',
			//])
		;
	}

	public function addExtraBundle (string $bundleName): self
	{
		$this->extraBundles[$bundleName] = ['all' => true];

		return $this;
	}

	public function addExtraConfigFile (string $config): self
	{
		$this->extraConfig[] = $config;

		return $this;
	}

	public function addExtraRoutesFile (string $route): self
	{
		$this->extraRoutes[] = $route;

		return $this;
	}

	public function registerBundles (): iterable
	{
		$contents = require $this->getBundlesPath();
		$contents = array_merge($contents, $this->extraBundles);

		foreach ($contents as $class => $envs) {
			if ($envs[$this->environment] ?? $envs['all'] ?? false) {
				yield new $class();
			}
		}
	}

	public function handleOptions (array $options): void
	{
		if (array_key_exists('config', $options) && is_callable($config = $options['config'])) {
			$config($this);
		}
	}

	/**
	 * @throws Exception
	 */
	protected function build (ContainerBuilder $container): void
	{
		$loader = $this->getContainerLoader($container);

		// Load config for Test App
		$loader->load($this->getTestPackagesConfigDir() . '/framework.php');
		$loader->load($this->getTestPackagesConfigDir() . '/doctrine.php');

		// Load service of Bundle
		$loader->load($this->getTestConfigDir() . '/services.php');

		// Load Fixtures and Factories of Bundle
		$loader->load($this->getConfigDir() . '/factories.php');
		$loader->load($this->getConfigDir() . '/fixtures.php');

		$extraConfig = array_unique($this->extraConfig);

		foreach ($extraConfig as $config) {
			$loader->load($config);
		}
	}

	private function getBundlesPath (): string
	{
		return $this->getTestConfigDir() . '/bundles.php';
	}

	private function getTestConfigDir (): string
	{
		return $this->getProjectDir() . '/app/config';
	}

	private function getTestPackagesConfigDir (): string
	{
		return $this->getTestConfigDir() . '/packages';
	}
}
