<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\CommentBundle\Entity\Comment;
use Mvondo\CommentBundle\Form\CommentType;
use Mvondo\CommentBundle\Entity\Kiff;

class VideoController extends Controller {

    public function viewAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        
        if (!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBySlug($slug)))
                throw $this->createNotFoundException("This video doesn't exist!!");
        
        $kiff=$em->getRepository('CommentBundle:Kiff')->findBy(array('video'=>$video, 'user'=>  $this->getUser()))?true:false;
        
        $commentCount=count($em->getRepository('CommentBundle:Comment')->findBy(array('video'=>$video, 'parent'=>null)));
        
       
        
        $comment=new Comment();
        
        $form = $this->get('form.factory')->create(new CommentType(), $comment);
        $menu = array(
             'link' => $this->generateUrl('mvondo_video_view', array('slug' => $video->getSlug())),
             'title' => 'Vidéo',
             'slug' => ''
         );
        return $this->render('site/view_video.html.twig', array(
                    'form' => $form->createView(),
                    'video' => $video,
                    'menu' => $menu,
                    'commentCount'=>$commentCount,
                    'kiff' => $kiff
        ));
    }
    
    public function updateLikeAction(){
        $em = $this->getDoctrine()->getManager();
        
        $request = $this->container->get('request');
        if($request->isXmlHttpRequest()){
             $video_id=$request->get('video_id');
             $video = $em->getRepository('MvondoVideoBundle:Video')->find($video_id);
             
             $kiff=$em->getRepository('CommentBundle:Kiff')->findBy(array('video'=>$video, 'user'=>  $this->getUser()));
             
             if($kiff){
                 foreach ($kiff as $k){
                    $em->remove($k);
                 }
                 $em->flush();
                 $ret=false;
             }else{
                 $kiff=new Kiff();
                 $kiff->setUser($this->getUser());
                 $kiff->setVideo($video);
                 $em->persist($kiff);
                 $em->flush();
                 $ret=true;
             }
            
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse($ret);
    }
    
    
}
