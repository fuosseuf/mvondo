<?php

namespace Mvondo\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheController extends Controller {

    private function getCacheResponse($max_age) {
        $response = new Response();
        $response->setMaxAge($max_age);
        $response->setVary('Accept-Encoding');
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    protected function getPrivateResponse($max_age = 1800) {
        $response = $this->getCacheResponse($max_age);
        $response->setPrivate();
        return $response;
    }

    protected function getPublicResponse($share_age = 1800, $max_age = 1800) {
        $response = $this->getCacheResponse($max_age);
        $response->setPublic();
        $response->setSharedMaxAge($share_age);
        return $response;
    }
    
    protected function getLastModifiedResponse(\DateTime $last_modified) {
        $response = new Response();
        $response->setPublic();
        $response->setVary('Accept-Encoding');
        $response->setLastModified($last_modified);
        return $response;
    }

}
