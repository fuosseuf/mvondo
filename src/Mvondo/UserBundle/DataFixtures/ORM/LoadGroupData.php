<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadUserData
 *
 * @author rodrigue
 */

namespace Mvondo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mvondo\UserBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $groupAdmin = new Group();
        $groupAdmin->setName('Admin');
        $groupAdmin->setRole('ROLE_ADMIN');

        $groupArtist = new Group();
        $groupArtist->setName('Artist');
        $groupArtist->setRole('ROLE_ARTIST');
        
        $group = new Group();
        $group->setName('Standart');
        $group->setRole('ROLE_USER');

        $manager->persist($groupAdmin);
        $manager->persist($groupArtist);
        $manager->persist($group);
        $manager->flush();

        $this->addReference('admin-group', $groupAdmin);
        $this->addReference('artist-group', $groupArtist);
        $this->addReference('user-group', $group);
    }

    public function getOrder() {
        return 1;
    }

}
