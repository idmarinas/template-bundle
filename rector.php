<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 27/09/2026, 23:19
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
use Zenstruck\Foundry\Utils\Rector\FoundrySetList;

return RectorConfig::configure()
	->withPaths([
		__DIR__.'/config',
		__DIR__.'/src',
		__DIR__.'/tests',
	])
	// uncomment to reach your current PHP version
	->withPhpSets(php83: true)
	->withPreparedSets(
		phpunitCodeQuality  : true,
		phpunitNarrowAsserts: true,
		phpunitMockToStub   : true,
		doctrineCodeQuality : true,
		symfonyCodeQuality  : true,
		symfonyConfigs      : true
	)
	->withTypeCoverageLevel(0)
	->withDeadCodeLevel(0)
	->withCodeQualityLevel(0)
	->withComposerBased(twig: true, doctrine: true, phpunit: true, symfony: true)
	->withSymfonyContainerXml(__DIR__.'/var/cache/dev/App_KernelDevDebugContainer.xml')
	->withSets([
		FoundrySetList::FOUNDRY_2_9,
	])
	->withSkip([
		__DIR__.'/tests/app/config/bundles.php',
	])
;
