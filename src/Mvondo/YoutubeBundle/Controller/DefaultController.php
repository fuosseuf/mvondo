<?php

namespace Mvondo\YoutubeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request, $name)
    {
        $client = new \Google_Client();
        $client->setDeveloperKey($this->getParameter("google_developper_key"));
        $client->setClientId($this->getParameter("google_client_ID"));
        $client->setClientSecret($this->getParameter("google_client_secret"));
        $client->setRedirectUri("http://www.mvondo.dev/app_dev.php/hello/toto");
        $client->setScopes("https://www.googleapis.com/auth/youtube");
        
        $youtube = new \Google_Service_YouTube($client);
        
        if($request->query->get('code')){
            $client->authenticate($request->query->get('code'));
            $client->getAccessToken(); die('3333');
        }
        $results = $youtube->search->listSearch('id,snippet', array(
            'q' => 'ndombolo',
            'maxResults' => 10,
            'type' => 'video'
        ));
        //print_r($results);
        die(print_r($client->getAccessToken()));
        
        return $this->render('MvondoYoutubeBundle:Default:index.html.twig', array('name' => $name));
    }
}
