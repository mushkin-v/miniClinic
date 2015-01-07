<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDoctorLogin extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $doctor = new User();
        $doctor
            ->setIsDoctor(true)
            ->setUsername('doctor')
            ->setEmail('doctor@doctor.com')
            ->setPlainPassword('doctor')
            ->setEnabled('true')
            ->setCardNumber(2)
            ->setRoles(array(User::ROLE_DEFAULT))
        ;

        $manager->persist($doctor);

        $manager->flush();

        $this->addReference('doctor', $doctor);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}
