<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of webtvController
 *
 * @author rodrigue
 * 
 */

namespace Mvondo\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Entity\Video;

class WebtvController extends Controller {
    //put your code here
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();
        $videoes = $em->getRepository('MvondoVideoBundle:Video')->findAll();
        return $this->render('site/webtv.html.twig', array(
                    'categories' => $categories,
                    'videos' => $videoes
        ));
    }
}
