<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Form\CategoryType;

class CategoryController extends CacheController {

    public function indexAction($page) {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();
        $menu = array(
             'link' => $this->generateUrl('mvondo_category_list'),
             'title' => "Toutes les catégories",
             'slug' =>''
         );
        return $this->render('site/list_category.html.twig', array(
                    'categories' => $categories,
                    'menu' => $menu
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
            $videos = $em->getRepository('MvondoVideoBundle:Video')->findAll();
        }
        
        foreach($videos as $video){
            if($video){
                $kiff=$em->getRepository('CommentBundle:Kiff')->findBy(array('video'=>$video));
                $video->setKiffCount(count($kiff));
            }
        }
         $request = $this->container->get('request');
         if($request->isXmlHttpRequest()){
             $vids = array();
             foreach ($videos as $key => $value) {
                 $vids[$key] = array(
                     'data-key' => $value->getPlayerKey(),
                     'data-title' => $value->getTitle(), 
                     'data-link' => $this->get('router')->generate('mvondo_video_view', array('slug' => $value->getSlug())),
                     'data-duree' => $value->getDuration(),
                     'data-artist' => $value->getUser()->getUserName()
                 );
             }
             return new \Symfony\Component\HttpFoundation\JsonResponse($vids);
         }
         $response = $this->getPublicResponse(600,600);
         $menu = array(
             'link' => $this->generateUrl('mvondo_category_view', array('slug' => $category->getSlug())),
             'title' => $category->getName(),
             'slug' =>$category->getSlug()
         );
        return $this->render('site/view_category.html.twig', array(
                    'category' => $category,
                    'videos' => $videos,
                    'menu' => $menu,
        ), $response);
    }

}
