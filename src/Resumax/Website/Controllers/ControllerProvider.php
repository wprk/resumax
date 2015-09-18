<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
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
class ControllerProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $ifLoggedIn = function (Request $request, Application $app) {
            if ($app['user']) {
                return new RedirectResponse($app['url_generator']->generate('cv'));
            }
        };

        $controllers = $app['controllers_factory'];

        $controllers
            ->get('/', array($this, 'homeAction'))
            ->bind('home')
            ->value('page', 'home')
            ->before($ifLoggedIn);

        $controllers
            ->get('/cv', array($this, 'cvAction'))
            ->bind('cv')
            ->value('page', 'cv');

        return $controllers;
    }

    public function homeAction(Application $app, $page)
    {
        $page = basename($page);

        return $app['twig']->render('home/' . sprintf('%s.twig', $page), array(
            'page' => $page,
        ));
    }

    public function cvAction(Application $app, $page)
    {
        $page = basename($page);

        return $app['twig']->render('cv/' . sprintf('%s.twig', $page), array(
            'page' => $page,
        ));
    }
}
