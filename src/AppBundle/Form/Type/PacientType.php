<?php
namespace  AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('card_number', 'integer')
            ->add('name', 'text')
            ->add('lastname', 'text')
            ->add('surname', 'text')
            ->add('age', 'integer')
            ->add('adress', 'text')
            ->add('phone', 'text')
            ->add('email', 'email');
    }

    public function getName()
    {
        return 'pacient';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pacient',
            'csrf_protection' => false,
        ));
    }
}
