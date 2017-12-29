<?php

namespace Lexik\TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lexik\TestBundle\Entity\Group_name;

class GroupFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $group1 = new Group_name();
        $group1->setName('groupe un');
        $manager->persist($group1);
        

        $group2 = new Group_name();
        $group2->setName('groupe deux');
        $manager->persist($group2);
        

        $group3 = new Group_name();
        $group3->setName('groupe trois');
        $manager->persist($group3);
        

        $manager->flush();
        
        $this->addReference('group1', $group1);
        $this->addReference('group2', $group2);
        $this->addReference('group3', $group3);



    }        
    public function getOrder()
    {
        return 1; 
    }
}