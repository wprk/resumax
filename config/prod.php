<?php

// configure your app for the production environment

// For the sake of demonstration,
// everything that normally goes in here was moved to src/app.php.

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'dbname' => 'resumax',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'pelican123',
);