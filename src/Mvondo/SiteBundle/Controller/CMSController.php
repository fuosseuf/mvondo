<?php

namespace Mvondo\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CMSController extends Controller
{
    public function aboutusAction()
    {
        return $this->render('MvondoSiteBundle:CMS:aboutus.html.twig');
    }
    
        public function helpAction()
    {
        return $this->render('MvondoSiteBundle:CMS:help.html.twig');
    }
    
        public function faqAction()
    {
        return $this->render('MvondoSiteBundle:CMS:faq.html.twig');
    }
    
        public function partnersAction()
    {
        return $this->render('MvondoSiteBundle:CMS:partners.html.twig');
    }
}
