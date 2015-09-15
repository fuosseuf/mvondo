<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoController
 *
 * @author Steve
 */
namespace Mvondo\SiteBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mvondo\CommentBundle\Form\CommentType;


use Mvondo\CommentBundle\Entity\Comment;

class VideoController extends Controller{
    
    public function readerAction($id){
        
        $em=  $this->getDoctrine()->getManager();
        
        $video=$em->getRepository("MvondoVideoBundle:Video")->find($id);
        
        $commentsLst=$em->getRepository("CommentBundle:Comment")->findBy(array("video" => $video));
        
        
        $comment=new Comment();
        $form = $this->get('form.factory')->create(new CommentType(), $comment);
        
        return $this->render('MvondoSiteBundle:Video:video.html.twig', array('video' => $video , 'commentLst' => $commentsLst, 'form'=>$form->createView()));
    }
}
