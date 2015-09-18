<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'dbname' => 'resumax',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'pelican123',
);

$app['twig.path'] = array(__DIR__ . '/../resources');
$app['twig.loader.filesystem']->addPath(__DIR__ . '/../resources/user/', 'user');
$app['twig.options'] = array('cache' => __DIR__ . '/../var/cache/twig');

$app['security.firewalls'] = array(
    /*
    // Ensure that the login page is accessible to all
    'login' => array(
        'pattern' => '^/user/login$',
    ),*/
    'secured_area' => array(
        'pattern' => '^.*$',
        'anonymous' => true,
        'remember_me' => array(),
        'form' => array(
            'login_path' => '/user/login',
            'check_path' => '/user/login_check',
        ),
        'logout' => array(
            'logout_path' => '/user/logout',
        ),
        'users' => $app->share(function ($app) { return $app['user.manager']; }),
    ),
);

$app['user.options'] = array(
    'templates' => array(
        'layout' => 'layout.twig',
        'view' => 'view.twig',
    ),
    'mailer' => array('enabled' => true),
    'userClass' => '\Resumax\Website\Auth\User',
);
