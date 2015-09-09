<?php

namespace Resumax\Controllers;

class Profile extends \SlimController\SlimController
{
    public function indexAction()
    {
        $this->render('partials/header', array(
            'active' => 'home'
        ));
        $this->render('profile/index', array(
            'someVar' => date('c')
        ));
        $this->render('partials/footer', array(
            'copyrightYear' => date('Y')
        ));
    }
}