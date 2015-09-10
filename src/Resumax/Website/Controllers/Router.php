<?php

/*
 * This file is part of the Wider Rewards Website Package.
 *
 * (c) Wider Plan <development@widerplan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Resumax\Website\Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dynamic page controller.
 *
 * @copyright 2014 Wider Plan
 * @license   Proprietary
 */
class Router implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $profile = new ProfileController(
            $app['twig'],
            $app['form.factory']
        );

        $controllers
            ->get('profile/home', array($profile, 'indexAction'))
            ->bind('profile');

        $auth = new AuthController(
            $app['twig'],
            $app['form.factory']
        );

        $controllers
            ->get('auth', array($auth, 'indexAction'))
            ->bind('auth');

        return $controllers;
    }
}
