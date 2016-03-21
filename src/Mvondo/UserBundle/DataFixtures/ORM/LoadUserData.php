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
use Mvondo\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('adminpass');
        $userAdmin->setFirstname('adminNom');
        $userAdmin->setFirstname('adminPrenom');
        $userAdmin->setEmail('admin@mvondo.com');
        $userAdmin->setGroup($this->getReference('admin-group'));
        $userAdmin->setCountry($this->getReference('country1'));

        $userArtist = new User();
        $userArtist->setUsername('artist');
        $userArtist->setPassword('artistpass');
        $userArtist->setFirstname('artistNom');
        $userArtist->setFirstname('artistPrenom');
        $userArtist->setEmail('artist@mvondo.com');
        $userArtist->setGroup($this->getReference('artist-group'));
        $userArtist->setCountry($this->getReference('country2'));

        $user = new User();
        $user->setUsername('user');
        $user->setPassword('userpass');
        $user->setFirstname('userNom');
        $user->setFirstname('userPrenom');
        $user->setEmail('user@mvondo.com');
        $user->setGroup($this->getReference('user-group'));
        $user->setCountry($this->getReference('country3'));

        $manager->persist($userAdmin);
        $manager->persist($userArtist);
        $manager->persist($user);
        $manager->flush();

        $this->addReference('admin-user', $userAdmin);
        $this->addReference('artist-user', $userArtist);
        $this->addReference('user', $user);
    }

    public function getOrder() {
        return 3;
    }

}
