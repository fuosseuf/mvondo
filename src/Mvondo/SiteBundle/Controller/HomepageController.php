<?php

namespace Mvondo\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\SiteBundle\Entity\Image;
use Mvondo\SiteBundle\Form\ImageType;


class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $img = new Image();
        $form = $this->get('form.factory')->create(new ImageType(), $img);
        
        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($img);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Image bien enregistrée.');
            
            return $this->render('MvondoSiteBundle:Homepage:index.html.twig', array('img' => $img ));
        }
        return $this->render('MvondoSiteBundle:Homepage:index.html.twig', array('form' => $form->createView() ));
    }
    
    public function menuAction() {
        $em = $this->getDoctrine()->getManager();
    }
    
    public function authAction(Request $request) {
        if($request->query->has('code')){ 
            $client = $this->get('mvondo_youtube.google_client');
            $client->setRedirectUri("http://www.mvondo.local.fr/app_dev.php/authentication");
            $client->authenticate($request->query->get('code'));
            $request->getSession()->set('token', $client->getAccessToken());
        }
        return $this->redirect($this->generateUrl('mvondo_video_user_add', array('username' => $this->getUser()->getUsername())));
        
    }
    
}

