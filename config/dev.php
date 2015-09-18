<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'dbname' => 'resumax',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'pelican123',
);

$app['user.options'] = array(
    'templates' => array(
        'layout' => 'layout.twig',
        'view' => 'view.twig',
    ),
    'mailer' => array('enabled' => false),
    'userClass' => '\Resumax\Website\Auth\User',
);
