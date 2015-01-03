<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //$container = new ContainerBuilder();
        //$userManager = $container->get('fos_user.user_manager');

        $user = new User();
        $user
            ->setUsername('user')
            ->setEmail('user@user.com')
            ->setPlainPassword('user')
            ->setEnabled('true')
            ->setCardNumber(1)
            ->setEmailCanonical('user@user.com')
            ->setRoles(array(User::ROLE_DEFAULT))
            ->setUsernameCanonical('user')
        ;

        //$FOSUser = $userManager->createUser($user, false);

        //$userManager->updateUser($user);

        $manager->persist($user);

        $manager->flush();
    }
}
