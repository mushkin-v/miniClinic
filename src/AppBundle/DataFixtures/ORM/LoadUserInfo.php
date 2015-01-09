<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Pacient;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserInfo extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('user');
        $pacient = new Pacient();
        $pacient
            ->setCardNumber($user->getCardNumber())
            ->setName('Taras')
            ->setLastname('Grigorievich')
            ->setSurname('Shevchenko')
            ->setAge(35)
            ->setAdress('Mexico, Atlanta, portRoyale st., 35/1')
            ->setPhone('+3097-333-33-33')
            ->setEmail($user->getEmail())
            ->setUser($user)
        ;

        $manager->persist($pacient);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}
