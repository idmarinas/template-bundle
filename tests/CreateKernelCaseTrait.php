<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 22:13
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    CreateKernelCaseTrait.php
 * @date    13/03/2025
 * @time    19:40
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Template\Tests;

use Symfony\Component\HttpKernel\KernelInterface;

trait CreateKernelCaseTrait
{
	protected static function createKernel (array $options = []): KernelInterface
	{
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}
}
