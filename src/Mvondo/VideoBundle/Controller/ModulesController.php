<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ModulesController extends Controller {

    public function home_lecteurAction() {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAllLimitBy(10);

        return $this->render('modules/home_lecteur.html.twig', array(
                    'videos' => $videos,
        ));
    }

    public function last_videosAction() {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAllLimitBy(9);

        return $this->render('modules/last_videos.html.twig', array(
                    'videos' => $videos,
        ));
    }

    public function list_categoryAction() {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MvondoVideoBundle:Category')->listCategoryNbVideos();
        return $this->render('modules/list_category.html.twig', array(
                    'categories' => $categories,
        ));
    }

    public function category_modAction($slug, $nb) {
        $em = $this->getDoctrine()->getManager();
        if (!($category = $em->getRepository('MvondoVideoBundle:Category')->findOneBySlug($slug)))
            throw $this->createNotFoundException("This category doesn't exist!!");

        $videos = $category->getVideos();
        return $this->render('modules/category_mod.html.twig', array(
                    'videoes' => $videos,
        ));
    }

    public function highlight_categoryAction($id) {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MvondoVideoBundle:Category')->find($id);
        $video = $em->getRepository('MvondoVideoBundle:Video')->find(3);

        return $this->render('modules/highlight_category.html.twig', array(
                    'video' => $video,
        ));
    }

}
