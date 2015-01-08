<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Pacient;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdminInfo extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $admin = $this->getReference('admin');

        $doctor = new Doctor();
        $doctor
            ->setCardNumber($admin->getCardNumber())
            ->setName('Admin')
            ->setLastname('Admin Lastname')
            ->setSurname('Admin Surname')
            ->setAge(100)
            ->setAdress('Admin Adress')
            ->setPhone('Admin Phone')
            ->setJobTitle('Admin Heads Doctor')
            ->setOtherInfo('ADmin Heads Doctor Info')
            ->setEmail($admin->getEmail())
            ->setUser($admin)
        ;

        $manager->persist($doctor);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
