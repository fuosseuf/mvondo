<?php

namespace Mvondo\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CommentBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function getCommentLstAction( $video_id){
        
        $em = $this->getDoctrine()->getManager();
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        $commLst=$em->getRepository("CommentBundle:Comment")->findBy(array('video'=>$video));
        
        //*/
        //if($request->isXmlHttpRequest()) {
            
            //$comment= $request->request->get('data').'yo';
 
            return $this->render('site/commentLst.html.twig', array('video_id' => $video_id, "commLst"=>$commLst));
        //}
        
        //$response=array('code'=>200, 'success'=>true);
        
        //return new Response(json_encode($response));
    }
    
    public function updateAction( $video_id){
        
        $em = $this->getDoctrine()->getManager();
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        $content=$this->getRequest()->get('comcontent');
        
        $comment=new \Mvondo\CommentBundle\Entity\Comment();
        
        $comment->setContent($content);
        $comment->setVideo($video);
        $comment->setUser($this->getUser());
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
        
        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));   
        
    }
}
