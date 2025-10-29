<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 29/10/2025, 16:47
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    rector.php
 * @date    02/01/2025
 * @time    22:23
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
	->withPaths([
		__DIR__ . '/config',
		__DIR__ . '/factories',
		__DIR__ . '/fixtures',
		__DIR__ . '/src',
		__DIR__ . '/tests',
	])
	->withPhpSets(php83: true)
	->withPreparedSets(
		phpunitCodeQuality : true,
		doctrineCodeQuality: true,
		symfonyCodeQuality : true,
		symfonyConfigs     : true
	)
	->withTypeCoverageLevel(0)
	->withDeadCodeLevel(0)
	->withCodeQualityLevel(0)
	->withImportNames(importDocBlockNames: false, removeUnusedImports: true)
	->withComposerBased(twig: true, doctrine: true, symfony: true)
	->withSymfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml')
	->withSkip([
		__DIR__ . '/tests/Fixtures/app/config/bundles.php',
	])
;
