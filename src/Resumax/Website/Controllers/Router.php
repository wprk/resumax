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
            $app['twig']
        );

        $controllers
            ->get('profile/home', array($profile, 'indexAction'))
            ->bind('profile');

        return $controllers;
    }
}
