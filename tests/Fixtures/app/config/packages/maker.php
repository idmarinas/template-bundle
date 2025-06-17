<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "idmarinas" on 18/02/2025, 16:13
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    maker.php
 * @date    04/01/2025
 * @time    12:14
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Template\IdmTemplateBundle;
use ReflectionClass;

return static function (ContainerConfigurator $container) {
	$container->extension('maker', [
		'root_namespace' => (new ReflectionClass(IdmTemplateBundle::class))->getNamespaceName(),
	]);
};
