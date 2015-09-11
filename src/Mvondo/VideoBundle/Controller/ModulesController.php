<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ModulesController extends Controller {

    public function home_lecteurAction() {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAll();

        return $this->render('MvondoVideoBundle:Modules:home_lecteur.html.twig', array(
                    'videos' => $videos,
        ));
    }

    public function last_videosAction() {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAll();

        return $this->render('MvondoVideoBundle:Modules:last_videos.html.twig', array(
                    'videos' => $videos,
        ));
    }

    public function highlight_categoryAction($id) {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MvondoVideoBundle:Category')->find($id);
        $video = $em->getRepository('MvondoVideoBundle:Video')->find(3);

        return $this->render('MvondoVideoBundle:Modules:highlight_category.html.twig', array(
                    'video' => $video,
        ));
    }

}
