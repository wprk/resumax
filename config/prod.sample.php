<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// For the sake of demonstration,
// everything that normally goes in here was moved to src/app.php.

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'dbname' => 'exampledb',
    'host' => 'localhost',
    'user' => 'user',
    'password' => 'password',
);
