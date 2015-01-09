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
            ->setName('Ivan')
            ->setLastname('Ivanovich')
            ->setSurname('Ivanov')
            ->setAge(50)
            ->setAdress('USA, New Yourk, Shevchenko st., 50/1')
            ->setPhone('+38093-123-12-12')
            ->setJobTitle('Heads Doctor')
            ->setOtherInfo('Doctor of the year 2013-2014')
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
