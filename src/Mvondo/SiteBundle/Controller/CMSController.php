<?php

namespace Mvondo\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CMSController extends Controller {

    public function aboutusAction() {
        return $this->render('site/aboutus.html.twig');
    }

    public function helpAction() {
        return $this->render('site/help.html.twig');
    }

    public function faqAction() {
        return $this->render('site/faq.html.twig');
    }

    public function partnersAction() {
        return $this->render('site/partners.html.twig');
    }

}
