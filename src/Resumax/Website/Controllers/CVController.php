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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CVController
{
    /** @var \Twig_Environment Templating engine */
    private $templating;

    /**
     * Constructor.
     *
     * @param Twig_Environment $templating
     */
    public function __construct(
        \Twig_Environment $templating
    ) {
        $this->templating = $templating;
    }

    public function indexAction(Request $request)
    {
        return new Response($this->templating->render('cv/index.twig', array(

        )));
    }
}
