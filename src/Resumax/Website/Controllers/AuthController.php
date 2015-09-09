<?php

namespace Resumax\Website\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    /** @var \Twig_Environment Templating engine */
    private $templating;

    /**
     * Constructor.
     *
     * @param Twig_Environment        $templating
     */
    public function __construct(
        \Twig_Environment $templating
    ) {
        $this->templating = $templating;
    }

    public function authAction()
    {
        return new Response($this->templating->render('auth/login.html.twig', array(

        )));
    }
}