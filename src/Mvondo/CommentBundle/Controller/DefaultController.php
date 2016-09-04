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
        $lst=$em->getRepository("CommentBundle:Comment")->findBy(array('video'=>$video));
        $commLst=array();
        foreach($lst as $comm){
            if(is_null($comm->getParent())){
                $commLst[]=$comm;
            }
        }
        
        //*/
        //if($request->isXmlHttpRequest()) {
            
            //$comment= $request->request->get('data').'yo';
 
            return $this->render('site/commentLst.html.twig', array('video_id' => $video_id, "commLst"=>$commLst));
        //}
        
        //$response=array('code'=>200, 'success'=>true);
        
        //return new Response(json_encode($response));
    }
    
    public function getAnsLstAction(){
        $comment_id=$this->getRequest()->get('commentparentid');
        $em = $this->getDoctrine()->getManager();
        $comment=$em->getRepository('CommentBundle:Comment')->find($comment_id);
        $lst=$em->getRepository("CommentBundle:Comment")->findBy(array('parent'=>$comment));
        return $this->render('site/commentAnsLst.html.twig', array("commLst"=>$lst));
    }
    
    public function updateAction( $video_id){
        
        $em = $this->getDoctrine()->getManager();
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($video_id);
        $content=$this->getRequest()->get('comcontent');
        $parentid=$this->getRequest()->get('commentparentid');
        
        $comment=new \Mvondo\CommentBundle\Entity\Comment();
        
        $comment->setContent($content);
        $comment->setVideo($video);
        $comment->setUser($this->getUser());
        
        if($parentid){
            $parent=$em->getRepository('CommentBundle:Comment')->find($parentid);
            $comment->setParent($parent);
            
        }
        $em->persist($comment);
        $em->flush();
        
        if(isset($parent) && $parent){
            $childLst=$em->getRepository('CommentBundle:Comment')->findBy(array('parent'=> $parent));
        }else{
            $childLst=array();
        }
        
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
        $response=array('code'=>200, 'success'=>true, 'children'=>$childLst);
        
        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));   
        
    }
}
