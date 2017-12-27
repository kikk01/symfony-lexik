<?php

namespace Lexik\TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lexik\TestBundle\Entity\User;
use Lexik\TestBundle\DataFixtures\ORM\GroupFixtures;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setSurname('Dubois');
        $user1->setName('Marco');
        $user1->setEmail('un@gmail.com');
        $user1->setBirthDate(new \DateTime('1980-10-18'));
        $this->getReference('group1')->addUser($user1);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setSurname('Desbois');
        $user2->setName('Jeanine');
        $user2->setEmail('deux@gmail.com');
        $user2->setBirthDate(new \DateTime('1980-09-18'));
        $this->getReference('group1')->addUser($user2);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setSurname('Dupont');
        $user3->setName('Jean');
        $user3->setEmail('trois@gmail.com');
        $user3->setBirthDate(new \DateTime('1980-10-18'));
        $this->getReference('group2')->addUser($user3);
        $manager->persist($user3);

        $user4 = new User();
        $user4->setSurname('Despont');
        $user4->setName('Baptiste');
        $user4->setEmail('quatre@gmail.com');
        $user4->setBirthDate(new \DateTime('1980-10-18'));
        $this->getReference('group2')->addUser($user4);
        $manager->persist($user4);

        $user5 = new User();
        $user5->setSurname('Maurice');
        $user5->setName('Jean');
        $user5->setEmail('cinq@gmail.com');
        $user5->setBirthDate(new \DateTime('1980-10-18'));
        $this->getReference('group3')->addUser($user5);
        $manager->persist($user5);

        $user6 = new User();
        $user6->setSurname('Michel');
        $user6->setName('Marie');
        $user6->setEmail('six@gmail.com');
        $user6->setBirthDate(new \DateTime('1980-10-18'));
        $this->getReference('group3')->addUser($user6);
        $manager->persist($user6);

        $manager->flush();
    }
    public function getOrder()
    {
      return 2; 
    }
}