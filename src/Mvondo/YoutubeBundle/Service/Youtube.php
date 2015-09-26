<?php

namespace Mvondo\YoutubeBundle\Service;

use Mvondo\VideoBundle\Entity\Video;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Doctrine\ORM\EntityManager;

class Youtube {

    private $client;
    private $google_youtube;
    private $nextPageToken;
    private $prevPageToken;
    private $securityContext;
    private $em;

    public function __construct(SecurityContextInterface $securityContext, EntityManager $entityManager) {
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

    function search($keyword, $category_id) {
        $result = $this->google_youtube->search->listSearch('id,snippet', array(
            'q' => $keyword,
            'maxResults' => 20,
            'type' => 'video'
        ));
        $this->nextPageToken = $result->nextPageToken;
        $this->prevPageToken = $result->prevPageToken;
        $origin = $this->em->getRepository('MvondoVideoBundle:Origin')->findOneByName('YouTube');
        $category = $this->em->getRepository('MvondoVideoBundle:Category')->find($category_id);
        $videos = array();
        foreach ($result->items as $key => $value) {
            $video = new Video();
            $video->setUser($this->securityContext->getToken()->getUser());
            $video->setOrigin($origin);
            $video->addCategory($category);
            $video->setTitle($value['snippet']['title']);
            $video->setDescription($value['snippet']['description']);
            $video->setImage($value['snippet']['thumbnails']['high']['url']);
            $video->setPlayerKey($value['id']['videoId']);

            $videos[] = $video;
        }

        return $videos;
    }

    public function save($videoKey, $category_id) {
        $result = $this->google_youtube->videos->listVideos('id,snippet,contentDetails', array(
            'id' => $videoKey
        ));
        $origin = $this->em->getRepository('MvondoVideoBundle:Origin')->findOneByName('YouTube');
        $category = $this->em->getRepository('MvondoVideoBundle:Category')->find($category_id);

        $value = $result->items[0];
        $video = new Video();
        $video->setUser($this->securityContext->getToken()->getUser());
        $video->setOrigin($origin);
        $video->addCategory($category);
        $video->setTitle($value['snippet']['title']);
        $video->setDescription($value['snippet']['description']);
        $video->setImage($value['snippet']['thumbnails']['high']['url']);
        $video->setPlayerKey($videoKey);
        $video->setDuration($value['contentDetails']['duration']);
        
        $this->em->persist($video);
        $this->em->flush();
    }

}
