<?php
namespace  AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorType extends AbstractType
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
            ->add('email', 'email')
            ->add('job_title', 'text')
            ->add('other_info', 'textarea');
    }

    public function getName()
    {
        return 'doctor';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Doctor',
            'csrf_protection' => false,
        ));
    }
}
