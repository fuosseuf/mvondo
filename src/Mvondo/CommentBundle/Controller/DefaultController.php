<?php

namespace Mvondo\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
use Mvondo\CommentBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Mvondo\CommentBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CommentBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function getCommentLstAction(Request $request, $video_id){
        
        $em = $this->getDoctrine()->getManager();
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        $commLst=$em->getRepository("CommentBundle:Comment")->findBy(array('video'=>$video));
        //*/
        if($request->isXmlHttpRequest()) {
            
            //$comment= $request->request->get('data').'yo';
 
            return $this->render('CommentBundle:Default:index.html.twig', array('video_id' => $video_id, "commLst"=>$commLst));
        }
        
        $response=array('code'=>200, 'success'=>true);
        
        return new Response(json_encode($response));
    }
    
    public function updateAction(Request $request, $video_id){
        
        $em = $this->getDoctrine()->getManager();
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        $content=$request->request->get('comcontent');
        
        $comment=new Comment();
        
        $comment->setContent($content);
        $comment->setVideo($video);
        $em->persist($comment);
        $em->flush();
        /*
        $em = $this->getDoctrine()->getManager();
        
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        
        //$request=  $this->container->get('request');
        
        $content=$request->query->get('content');
        
        
        
        $comment=new Comment();
        
        $form = $this->get('form.factory')->create(new CommentType(), $comment);
        
         if ($form->handleRequest($request)->isValid()) {
             
            $comment->setVideo($video);
            $em->persist($comment);
            $em->flush();
         }
        
        //$comment->setContent($content);
        
        
        
        //$em->flush();
        
        $commentsLst=$em->getRepository("CommentBundle:Comment")->findBy(array("video" => $video));
        //*/
        $response=array('code'=>200, 'success'=>true);
        
        return new Response(json_encode($response));   
        
    }
}
