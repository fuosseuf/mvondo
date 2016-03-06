<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoAdminController extends Controller {

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();

        if ($request->isMethod('POST')) {
            if ($request->isXmlHttpRequest()) {
                if (($videoKey = $request->request->get('id')) && ($catid = $request->request->get('catid'))) {
                    $client = $this->get('mvondo_youtube.google_client');
                    $youtube = $this->get('mvondo_youtube.google_youtube');
                    $youtube->setClient($client);
                    $youtube->save($videoKey, $catid);
                }
                return new \Symfony\Component\HttpFoundation\JsonResponse('Video ajouté');
            } else {
                $keyword = $request->request->get('keyword');
                $category_id = $request->request->get('category');
                $category = $em->getRepository('MvondoVideoBundle:Category')->find($category_id);
                $client = $this->get('mvondo_youtube.google_client');
                $youtube = $this->get('mvondo_youtube.google_youtube');
                $youtube->setClient($client);
                $results = $youtube->search($keyword, $category_id);
                return $this->render('site/add_admin_video.html.twig', array(
                            'category' => $category,
                            'videos' => $results
                ));
            }
        }



        return $this->render('site/add_admin_video.html.twig', array(
                    'categories' => $categories
        ));
    }

}
