<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Doctor;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDoctorInfo extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('doctor');
        $doctor = new Doctor();
        $doctor
            ->setCardNumber($user->getCardNumber())
            ->setName('Doctor')
            ->setLastname('Doctor Lastname')
            ->setSurname('Doctor Surname')
            ->setAge(50)
            ->setAdress('Doctor Adress')
            ->setPhone('Doctor Phone')
            ->setJobTitle('Heads Doctor')
            ->setOtherInfo('Heads Doctor Info')
            ->setEmail($user->getEmail())
            ->setUser($user)
        ;

        $manager->persist($doctor);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6; // the order in which fixtures will be loaded
    }
}
