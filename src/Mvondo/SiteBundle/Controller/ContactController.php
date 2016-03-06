<?php

namespace Mvondo\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function contactAction()
    {
        return $this->render('site/contact.html.twig');
    }
}
