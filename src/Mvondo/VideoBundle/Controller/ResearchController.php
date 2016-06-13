<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResearchController
 *
 * @author Steve
 */
namespace Mvondo\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ResearchController extends Controller{
    
    public function researchAction(){
        $request = Request::createFromGlobals();
        $s=$request->query->get('s');
        
        $em=  $this->getDoctrine()->getManager();
        $rep_v=$em->getRepository('MvondoVideoBundle:Video');
        $query=$rep_v->createQueryBuilder('v')
                ->where('v.title LIKE :title OR v.description LIKE :description')
                ->setParameters(array('title'=>'%'.$s.'%', 'description'=>'%'.$s.'%'))
                ->getQuery();
        
        $videos=$query->getResult();
        /*
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
             /*
             echo '<pre>';
             print_r($vids);
             echo '</pre>';
             //*/
        /*
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query->getResults(),//get the results here
            $this->requrest->get('page',1),
            4
        );
        //*/
        return $this->render('site/research_result.html.twig', array(
                    's' => $s,
                    'videos'=>$videos
            
        ));
    }
}
