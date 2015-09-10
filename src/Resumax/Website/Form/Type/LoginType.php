<?php

namespace Resumax\Website\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Login form type.
 */
class LoginType extends AbstractType
{
    /** {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'text', array(
            'label' => 'Email Address',
        ));
        $builder->add('password', 'text', array(
            'label' => 'Password',
        ));
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'login';
    }
}
