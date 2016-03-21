<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadOriginData
 *
 * @author rodrigue
 */

namespace Mvondo\VideoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mvondo\VideoBundle\Entity\Origin;

class LoadOriginData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $origin = new Origin();
        $origin->setName('YouTube');
        $origin->setWSaccount('Mvondo');
        $origin->setWSkey('Mvondo');
        
        $manager->persist($origin);
        $manager->flush();

        $this->addReference('origin', $origin);
    }

    public function getOrder() {
        return 4;
    }

}
