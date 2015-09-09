<?php

namespace Resumax\Website\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController
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

    public function indexAction()
    {
        return new Response($this->templating->render('profile/index.html.twig', array(

        )));
    }
}