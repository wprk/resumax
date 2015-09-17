<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app = require __DIR__.'/../src/app.php';

require 'dev.php';

use \Doctrine\DBAL\DriverManager;
use \Phpmig\Adapter\Doctrine\DBAL;

$app['db'] = $app->share(function () use ($app) {
    return DriverManager::getConnection($app['db.options']);
});

$app['phpmig.adapter'] = $app->share(function () use ($app) {
    return new DBAL($app['db'], 'migrations');
});

$app['phpmig.migrations_path'] = function () {
    return __DIR__ . '/../migrations';
};

return $app;
