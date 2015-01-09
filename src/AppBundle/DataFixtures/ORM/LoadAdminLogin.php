<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdminLogin extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin
            ->setIsDoctor(true)
            ->setUsername('admin')
            ->setEmail('miniclinic2015@gmail.com')
            ->setPlainPassword('admin')
            ->setEnabled(true)
            ->setCardNumber(0)
            ->setRoles(array(User::ROLE_SUPER_ADMIN))
        ;

        $manager->persist($admin);

        $manager->flush();

        $this->addReference('admin', $admin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
