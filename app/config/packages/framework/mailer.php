<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 24/03/2025, 17:34
 *
 * @project IDMarinas Template Bundle
 * @see     https://github.com/idmarinas/idm-template-bundle
 *
 * @file    mailer.php
 * @date    30/12/2024
 * @time    17:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $config) {
    $config
        ->mailer()
        ->dsn($_ENV['MAILER_DSN'] ?? 'null://null')
        ->envelope()->sender('idm_bundle@test.bundle')
    ;
    $config->mailer()->header('From', 'IDMarinas Template Bundle <idm_bundle@test.bundle>');
};
