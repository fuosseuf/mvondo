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

namespace Mvondo\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mvondo\SiteBundle\Entity\Country;

class LoadCountryData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $country1 = new Country();
        $country1->setName('France');
        $country1->setIsoCode('fr');

        $country2 = new Country();
        $country2->setName('Cameroun');
        $country2->setIsoCode('cv');

        $country3 = new Country();
        $country3->setName('Nigeria');
        $country3->setIsoCode('ng');

        $manager->persist($country1);
        $manager->persist($country2);
        $manager->persist($country3);
        $manager->flush();

        $this->addReference('country1', $country1);
        $this->addReference('country2', $country2);
        $this->addReference('country3', $country3);
    }

    public function getOrder() {
        return 2;
    }

}
