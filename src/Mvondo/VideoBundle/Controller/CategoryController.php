<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {

    public function indexAction($page) {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();

        return $this->render('site/list_category.html.twig', array(
                    'categories' => $categories,
        ));
    }

    public function viewAction($slug) {

        $em = $this->getDoctrine()->getManager();
        if ($slug != 'all') {
            if (!($category = $em->getRepository('MvondoVideoBundle:Category')->findOneBySlug($slug)))
                throw $this->createNotFoundException("This category doesn't exist!!");
            
            $videos = $category->getVideos();
            
        } else {
            $category = new Category();
            $category->setName("All");
            $videos = $em->getRepository('MvondoVideoBundle:Category')->findBySlug($slug);
        }

        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();
        return $this->render('site/view_category.html.twig', array(
                    'category' => $category,
                    'videos' => $videos,
        ));
    }

}
