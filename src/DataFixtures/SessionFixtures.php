<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Session;
use App\Enum\UserType;

class SessionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new Session();
        $user1->setUsername('admin');
        $user1->setPassword('P@ssw0rd');
        $user1->setType(UserType::Administrator);
        $manager->persist($user1);

        $user2 = new Session();
        $user2->setUsername('yuanma');
        $user2->setPassword('P@ssw0rd');
        $user2->setType(UserType::Student);
        $manager->persist($user2);

        $user3 = new Session();
        $user3->setUsername('padreYuanma');
        $user3->setPassword('P@ssw0rd');
        $user3->setType(UserType::Father);
        $manager->persist($user3);

        $user4 = new Session();
        $user4->setUsername('juanlu');
        $user4->setPassword('P@ssw0rd');
        $user4->setType(UserType::Directive);
        $manager->persist($user4);

        $user5 = new Session();
        $user5->setUsername('gopal');
        $user5->setPassword('P@ssw0rd');
        $user5->setType(UserType::Teacher);
        $manager->persist($user5);

        $manager->flush();
    }
}
