<?php

/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 03/01/2025, 19:46
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    BundleInitializationTest.php
 * @date    02/01/2024
 * @time    19:09
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

final class BundleInitializationTest extends KernelTestCase
{
	protected static function createKernel (array $options = []): KernelInterface
	{
		/** @var Kernel $kernel */
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}

	public function testInitBundle (): void
	{
		// Boot the kernel.
		$kernel = self::bootKernel([
			'config' => static function (Kernel $kernel) {
//				$kernel->addExtraBundle(BundleName::class);
//				$kernel->addExtraConfigFile('path/to/file.php');
//				$kernel->addExtraRoutesFile('path/to/file.php');
			},
		]);

		$this->assertTrue(true);
	}
}
