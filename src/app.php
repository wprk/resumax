<?php

use Silex\Application;
use Silex\Provider;

$app = new Application();
$app->register(new Provider\DoctrineServiceProvider());
$app->register(new Provider\SecurityServiceProvider());
$app->register(new Provider\RememberMeServiceProvider());
$app->register(new Provider\SessionServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
$app->register(new Provider\UrlGeneratorServiceProvider());
$app->register(new Provider\TwigServiceProvider());
$app->register(new Provider\SwiftmailerServiceProvider());

$userProvider = new Resumax\Website\Auth\UserServiceProvider();
$app->register($userProvider);

/*
 * Controllers */
$app->mount('', new Resumax\Website\Controllers\ControllerProvider);
$app->mount('/user', $userProvider);

return $app;
