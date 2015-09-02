<?php

namespace Mvondo\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction()
    {
        return $this->render('MvondoVideoBundle:Category:index.html.twig');
    }
}
