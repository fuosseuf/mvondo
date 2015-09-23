<?php

namespace Mvondo\YoutubeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\YoutubeBundle\Service\GoogleCLient;
use Mvondo\YoutubeBundle\Service\Youtube;

class YoutubeController extends Controller {

    public function searchAction(Request $request) {

        if ($keyword = $request->request->get('keyword')) {

            $client = $this->get('mvondo_youtube.google_client');
            $youtube = $this->get('mvondo_youtube.google_youtube');
            $youtube->setClient($client);
            $results = $youtube->search($keyword);

            return $this->render('MvondoYoutubeBundle:Youtube:search.html.twig', array('videos' => $results));
        }

        return $this->render('MvondoYoutubeBundle:Youtube:search.html.twig');
    }

}
