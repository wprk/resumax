<?php

namespace Resumax\Website;

require APP_PATH . 'vendor/opauth/opauth/lib/Opauth/' . 'Opauth.php';

class AuthLib {

	protected $configurations;
    protected $opauth_obj;

    public function __construct($configurations) {
    	$this->configurations = $configurations;
    }

    public function initialize() {
	    $this->opauth_obj = new Opauth($this->configurations);
	    $this->opauth_obj->run();
	}
}