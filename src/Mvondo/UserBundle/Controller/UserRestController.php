<?php

namespace Mvondo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserRestController extends Controller {

    public function getUserAction($username) {
        $user = $this->getDoctrine()->getRepository('MvondoUserBundle:User')->findOneByUsername($username);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }

}
