<?php

namespace Resumax\Website\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Resumax\Website\Form\Type\LoginType;
use Resumax\Website\Form\Type\RegisterType;

class AuthController
{
    /** @var \Twig_Environment Templating engine */
    private $templating;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * Constructor.
     *
     * @param Twig_Environment        $templating
     */
    public function __construct(
        \Twig_Environment $templating,
        FormFactoryInterface $formFactory
    ) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
    }

    public function indexAction(Request $request)
    {
        $loginError = false;
        $registerError = false;
        $loginForm = $this->formFactory->create(new LoginType);
        $loginForm->handleRequest($request);

        $registerForm = $this->formFactory->create(new RegisterType);
        $registerForm->handleRequest($request);

        if ($loginForm->isValid()) {
            $data = $loginForm->getData();
            if ($response = $this->loginUser($request, $data)) {
                return $response;
            } else {
                $loginError = true;
            }
        }

        if ($registerForm->isValid()) {
            $data = $registerForm->getData();
            if ($response = $this->registerUser($request, $data)) {
                return $response;
            } else {
                $registerError = true;
            }
        }

        return new Response($this->templating->render('auth/index.html.twig', array(
            'authError' => $authError,
            'page' => 'Auth',
            'loginForm' => $loginForm->createView(),
            'registerForm' => $registerForm->createView(),
        )));
    }

    /**
     * Validate login request and return response if valid.
     *
     * @param Request $request HTTP request
     * @param string Login data
     *
     * @return Response|null
     */
    private function loginUser(Request $request, $accessCodeValue)
    {
        $accessCodes = new AccessCodes();
        $codes = $accessCodes->getCodeData();
        if (isset($codes[$accessCodeValue])) {
            $request->getSession()->set('auth', $codes[$accessCodeValue]);
            return new RedirectResponse($this->urlGenerator->generate('home'));
        }
        return;
    }
}