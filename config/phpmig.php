<?php

$app = require __DIR__.'/../src/app.php';

require 'dev.php';

use \Phpmig\Adapter\Doctrine\DBAL;
use \Doctrine\DBAL\DriverManager;

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
