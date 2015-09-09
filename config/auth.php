<?php
    $config['auth'] = array(
        'path' => '/auth/login/',
        'callback_url' => 'http://example.com/auth/authenticate/',
        'callback_transport' => 'post',
        'security_salt' => 'rakhithanimesh123',

        'Strategy' => array(
            'Twitter' => array(
                'key' => 'twitter app key',
                'secret' => 'twitter app secret'
            ),
            'LinkedIn' => array(
                'api_key' => 'linkedin app key',
                'secret_key' => 'linkedin app secret'
            )
        ),
    );