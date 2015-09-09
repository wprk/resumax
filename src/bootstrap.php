
<?php

use SilexOpauth\OpauthExtension;

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
    $loader->addPath(__DIR__ . '/../resources/templates', 'templates');

    return $loader;
}));

// Configure opauth
$app['opauth'] = array(
    'login' => '/auth/login', // Generates a path /auth/login/{strategy}
    'callback' => '/resumax/auth/callback',
    'config' => array(
        'host' => ((array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].'/resumax',
        'request_uri' => substr($_SERVER['REQUEST_URI'], 8),
        'security_salt' => 'ResumaxCVmanager',
        'Strategy' => array(
            'Twitter' => array(
                'key' => 'sm8SbNTI8yrFHinDSXOJfGavJ',
                'secret' => 'STPz5xWZFb4VXJIGW73Qxy4n36Md1s0S7ty7VhRJKepbReNxQE'
            ),
        )
    )
);

// Enable extension
$app->register(new OpauthExtension($app));

// Listen for events
$app->on(OpauthExtension::EVENT_ERROR, function($e) {
    $this->log->error('Auth error: ' . $e['message'], ['response' => $e->getSubject()]);
    $e->setArgument('result', $this->redirect('/auth/login'));
});

$app->on(OpauthExtension::EVENT_SUCCESS, function($e) {
    $response = $e->getSubject();

    /*
       find/create a user, oauth response is in $response and it's already validated!
       store the user in the session
    */

    $e->setArgument('result', $this->redirect('/profile/home'));
});

$app->mount('', new Resumax\Website\Controllers\Router);

return $app;