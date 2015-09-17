<?php

/*
 * This file is part of the Resumax CV Manager package.
 *
 * (c) Will Parker <will@wipar.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Resumax;

use Resumax\Website\Auth\User as BaseUser;

class User extends BaseUser
{
    public function __construct($email)
    {
        parent::__construct($email);
    }

    public function getTwitterUsername()
    {
        return $this->getCustomField('twitterUsername');
    }

    public function setTwitterUsername($twitterUsername)
    {
        $this->setCustomField('twitterUsername', $twitterUsername);
    }

    public function validate()
    {
        $errors = parent::validate();

        if ($this->getTwitterUsername() && strpos($this->getTwitterUsername(), '@') !== 0) {
            $errors['twitterUsername'] = 'Twitter username must begin with @.';
        }

        return $errors;
    }
}
