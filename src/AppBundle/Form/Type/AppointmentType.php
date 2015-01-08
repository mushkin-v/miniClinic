<?php
namespace  AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date')
            ->add('time','collection', array(
                'type' => new AppointmentTimeType(),
                'allow_add'    => true,
                'prototype' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ));
    }

    public function getName()
    {
        return 'Appointment';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Appointment',
            'csrf_protection' => false,
        ));
    }
}