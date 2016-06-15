<?php

namespace Mvondo\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction()
    {
        $menu = array(
             'link' => "",
             'title' => "",
             'slug' => "agenda"
         );
        return $this->render('site/agenda.html.twig', array('menu' => $menu));
    }
}
