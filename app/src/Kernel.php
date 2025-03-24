<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 24/03/2025, 16:41
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
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
	use MicroKernelTrait;

	private array  $extraBundles    = [];
	private array  $extraRoutes     = [];
	private array  $extraConfig     = [];
	private string $testCachePrefix = '';
	private bool   $clearCache      = true;

	public function __construct (string $environment, bool $debug)
	{
		parent::__construct($environment, $debug);

		if ('test' === $this->environment) {
			$this->testCachePrefix = '/' . uniqid('', true);
		}
	}

	public function addExtraBundle (string $bundleName): self
	{
		$this->extraBundles[$bundleName] = ['all' => true];

		return $this;
	}

	public function addExtraConfig (string|array $config): self
	{
		if (is_array($config)) {
			$this->extraConfig = array_merge($this->extraConfig, $config);
		} else {
			$this->extraConfig[] = $config;
		}

		return $this;
	}

	public function addExtraRoutesFile (string $route): self
	{
		$this->extraRoutes[] = $route;

		return $this;
	}

	public function configureRoutes (RoutingConfigurator $routes): void
	{
		$extraRoutes = array_unique(array_merge([
			$this->getConfigDir() . '/routes.php',
			$this->getTestConfigDir() . '/routes.php',
		], $this->extraRoutes));

		foreach ($extraRoutes as $route) {
			if (file_exists($route)) {
				$routes->import($route);
			}
		}

		//$routes->import('security.route_loader.logout', 'service')->methods(['GET']);

		$routes
			->add('app_home', '/')
			->methods(['GET'])
			->controller(TemplateController::class)
//			->defaults([
//				'template' => 'path/to/template.html.twig',
//			])
		;
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

	public function getCacheDir (): string
	{
		return parent::getCacheDir() . $this->testCachePrefix;
	}

	public function shutdown (): void
	{
		parent::shutdown();

		if (!$this->clearCache) {
			return;
		}

		$cacheDirectory = $this->getCacheDir();
		$logDirectory = $this->getLogDir();

		$filesystem = new Filesystem();

		if ($filesystem->exists($cacheDirectory)) {
			$filesystem->remove($cacheDirectory);
		}

		if ($filesystem->exists($logDirectory)) {
			$filesystem->remove($logDirectory);
		}
	}

	public function clearCacheAfterShutdown (): self
	{
		$this->clearCache = true;

		return $this;
	}

	public function notClearCacheAfterShutdown (): self
	{
		$this->clearCache = false;

		return $this;
	}

	/**
	 * For add more config/routes/bundles to kernel
	 *
	 * <code>
	 *   <?php
	 *    use Symfony\Bundle\FrameworkBundle\Test\{
	 *      KernelTestCase,
	 *      WebTestCase
	 *    };
	 *
	 *    class TestKernel extends [(KernelTestCase|WebTestCase)]
	 *    {
	 *      public function testAnything (): void
	 *      {
	 *        $kernel = self::bootKernel([
	 *          'config' => static function (Kernel $kernel) {
	 *            $kernel->addExtraBundle(BundleName::class);
	 *            $kernel->addExtraConfigFile('path/to/file.php');
	 *            $kernel->addExtraRoutesFile('path/to/file.php');
	 *          }
	 *        ]);
	 *      }
	 *    }
	 * </code>
	 */
	public function handleOptions (array $options): void
	{
		if (array_key_exists('config', $options) && is_callable($config = $options['config'])) {
			$config($this);
		}
	}

	/**
	 * @throws Exception
	 */
	protected function configureContainer (
		ContainerConfigurator $container,
		LoaderInterface       $loader,
		ContainerBuilder      $builder
	): void {
		// Load config for Test App
		$loader->load($this->getTestPackagesConfigDir() . '/framework.php');

		$config = [
			'maker'                    => $this->getTestPackagesConfigDir() . '/maker.php',
			'doctrine'                 => $this->getTestPackagesConfigDir() . '/doctrine.php',
			'security'                 => $this->getTestPackagesConfigDir() . '/security.php',
			'stof_doctrine_extensions' => $this->getTestPackagesConfigDir() . '/stof_doctrine_extensions.php',
			'easy_admin'               => $this->getTestPackagesConfigDir() . '/easy_admin.php',
			'twig_component'           => $this->getTestPackagesConfigDir() . '/twig_component.php',
			// Load Fixtures and Factories of Bundle
			$this->getTestConfigDir() . '/factories.php',
			$this->getTestConfigDir() . '/fixtures.php',
		];

		foreach ($config as $extension => $file) {
			if (is_numeric($extension) || $builder->hasExtension($extension)) {
				$loader->load($file);
			}
		}

		// Load service of Bundle
		$loader->load($this->getTestConfigDir() . '/services.php');

		foreach ($this->extraConfig as $extension => $config) {
			if (is_array($config)) {
				$builder->loadFromExtension($extension, $config);
			} else {
				$loader->load($config);
			}
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
