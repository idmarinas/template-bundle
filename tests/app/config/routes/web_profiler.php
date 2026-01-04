<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/11/2025, 16:08
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    web_profiler.php
 * @date    07/11/2025
 * @time    14:56
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
	// @formatter:off
	$routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
	$routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');


	// @formatter:on
};
