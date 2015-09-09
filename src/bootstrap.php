<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider, array(
    'twig.path' => array(
        __DIR__.'/../resources',
    ),
));

$app['twig.loader.filesystem'] = $app->share($app->extend('twig.loader.filesystem', function ($loader) {
    $loader->addPath(__DIR__.'/../resources/templates', 'templates');

    return $loader;
}));

$app->mount('', new Resumax\Website\Controllers\Router);

return $app;