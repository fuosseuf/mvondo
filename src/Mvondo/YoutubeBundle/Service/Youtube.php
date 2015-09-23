<?php

namespace Mvondo\YoutubeBundle\Service;

use Mvondo\VideoBundle\Entity\Video;
use Symfony\Component\Security\Core\SecurityContextInterface;

class Youtube {

    private $client;
    private $google_youtube;
    private $nextPageToken;
    private $prevPageToken;
    private $securityContext;
    private $em;

    public function __construct(SecurityContextInterface $securityContext, EntityManager $entityManager)
    {
        $this->securityContext = $securityContext;
        $this->em = $entityManager;
    }
    

    function getClient() {
        return $this->client;
    }

    function setClient($client) {
        $this->client = $client;
        $this->google_youtube = new \Google_Service_YouTube($this->client);
    }

    function search($keyword) {
        $result = $this->google_youtube->search->listSearch('id,snippet,contentDetails', array(
            'q' => $keyword,
            'maxResults' => 20,
            'type' => 'video'
        ));
        $this->nextPageToken = $result->nextPageToken;
        $this->prevPageToken = $result->prevPageToken;
        $origin = $this->em->getRepository('MvondoVideoBundle:Origin')->findOneByName('YouTube');
        $videos = array();
        foreach ($result->items as $key => $value) {
            $video = new Video();
            $video->setUser($this->securityContext->getToken()->getUser());
            $video->setOrigin($origin);
            $video->setTitle($value['snippet']['title']);
            $video->setDescription($value['snippet']['description']);
            $video->setImageSmall($value['snippet']['thumbnails']['default']['url']);
            $video->setImageMedium($value['snippet']['thumbnails']['medium']['url']);
            $video->setImageLarge($value['snippet']['thumbnails']['high']['url']);
            $video->setPlayerKey($value['id']['videoId']);
            $video->setDuration($value['contentDetails']['duration']);
            
            $videos[] = $video;
        }
        
        return $videos;
    }

}
