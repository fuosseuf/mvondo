<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadCategoryData
 *
 * @author rodrigue
 */

namespace Mvondo\VideoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mvondo\VideoBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $category1 = new Category();
        $category1->setName('Music');
        $category1->setDescription('style musical');
        
        $category2 = new Category();
        $category2->setName('Comedy');
        $category2->setDescription('series africaines');
        
        $category3 = new Category();
        $category3->setName('Mode');
        $category3->setDescription('style/mode');


        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->flush();

        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
    }

    public function getOrder() {
        return 6;
    }

}
