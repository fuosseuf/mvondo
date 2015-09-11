<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller {

    public function viewAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        if (!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBySlug($slug)))
                throw $this->createNotFoundException("This video doesn't exist!!");
        
        return $this->render('MvondoVideoBundle:Video:view.html.twig', array(
                    'video' => $video
        ));
    }
}