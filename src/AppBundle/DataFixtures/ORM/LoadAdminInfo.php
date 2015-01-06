<?php

namespace AppBundle\DataFixtures\ORM;

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
        $pacient = new Pacient();
        $pacient
            ->setCardNumber($admin->getCardNumber())
            ->setName('Admin')
            ->setLastname('Admin Lastname')
            ->setSurname('Admin Surname')
            ->setAge(100)
            ->setAdress('Admin Adress')
            ->setPhone('Admin Phone')
            ->setEmail($admin->getEmail())
            ->setUser($admin)
        ;

        $manager->persist($pacient);

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
