<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\CommentBundle\Entity\Comment;
use Mvondo\CommentBundle\Form\CommentType;

class VideoController extends Controller {

    public function viewAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        
        if (!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBySlug($slug)))
                throw $this->createNotFoundException("This video doesn't exist!!");
        
        $comment=new Comment();
        echo $slug;
        
        $form = $this->get('form.factory')->create(new CommentType(), $comment);
        $menu = array(
             'link' => $this->generateUrl('mvondo_video_view', array('slug' => $video->getSlug())),
             'title' => 'Vidéo',
             'slug' => ''
         );
        return $this->render('site/view_video.html.twig', array(
                    'form' => $form->createView(),
                    'video' => $video,
                    'menu' => $menu
        ));
    }
}
