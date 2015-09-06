<?php

namespace Mvondo\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CMSController extends Controller {

    public function aboutusAction() {
        return $this->render('MvondoSiteBundle:CMS:aboutus.html.twig');
    }

    public function helpAction() {
        if ($this->get('security.context')->isGranted('ROLE_USER'))
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException("Desolé, Vous n'avez pas accès à cette page!");
        return $this->render('MvondoSiteBundle:CMS:help.html.twig');
    }

    /**
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function faqAction() {
        return $this->render('MvondoSiteBundle:CMS:faq.html.twig');
    }

    public function partnersAction() {
        return $this->render('MvondoSiteBundle:CMS:partners.html.twig');
    }

}
