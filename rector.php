<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/02/2025, 14:41
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
use Rector\Symfony\Set\SymfonySetList;

return RectorConfig::configure()
	->withPaths([
		__DIR__ . '/app/src',
		__DIR__ . '/factories',
		__DIR__ . '/fixtures',
		__DIR__ . '/src',
		__DIR__ . '/tests',
	])
	->withPhpSets(php82: true)
	->withPreparedSets(
		deadCode           : true,
		codeQuality        : true,
		codingStyle        : true,
		doctrineCodeQuality: true,
		symfonyCodeQuality : true,
		symfonyConfigs     : true,
		twig               : true
	)
	->withImportNames(removeUnusedImports: true)
	->withTypeCoverageLevel(0)
	->withSets([
		SymfonySetList::SYMFONY_64,
	])
	->withRules([])
	->withSkip([])
;
