<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
parent::buildForm($builder, $options);

$builder->add('card_number',null, array('label'=>'Card number:'));
}

public function getName()
{
return 'vit_user_registration';
}
}