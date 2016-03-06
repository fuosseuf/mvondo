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

    public function getInstanceSnippet() {
        return new \Google_Service_YouTube_VideoSnippet();
    }

    public function getInstanceVideo() {
        return new \Google_Service_YouTube_Video();
    }

    public function getInstanceStatus() {
        return new \Google_Service_YouTube_VideoStatus();
    }

    function getInstanceMedia() {
        return new \Google_Http_MediaFileUpload($client, $request, $mimeType, $data);
    }

    function getInstance() {
        return $this->google_youtube = new \Google_Service_YouTube($this->client);
        ;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
        $this->google_youtube = new \Google_Service_YouTube($this->client);
    }
    
    public function synchronize() {
         $result = $this->google_youtube->search->listSearch('id,snippet', array(
            'forMine' => true,
            'maxResults' => 50,
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
            $video->setImage($value['snippet']['thumbnails']['high']['url']);
            $video->setPlayerKey($value['id']['videoId']);

            $videos[] = $video;
    }
    return $videos;
    }

    public function upload($video) {
        $error = true;
        try {
            $snippet = $this->getInstanceSnippet();
            $snippet->setTitle($video->getTitle());
            $snippet->setDescription($video->getDescription());
            $snippet->setTags(array('tag1', 'tag2'));
            $snippet->setCategoryId('17');

            $status = $this->getInstanceStatus();
            $status->setPrivacyStatus('private');

            $videoY = $this->getInstanceVideo();
            $videoY->setSnippet($snippet);
            $videoY->setStatus($status);

            $this->client->setDefer(true);
            $chunkSizeBytes = 1 * 1024 * 1024;
            
            $video->upload();
            $request = $this->google_youtube->videos->insert('status,snippet', $videoY);
            $media = new \Google_Http_MediaFileUpload($this->client, $request, 'video/*', null, true, $chunkSizeBytes);
            $media->setFileSize(filesize($video->getPath()));

            // Read the media file and upload it chunk by chunk.
            $status = false;
            $handle = fopen($video->getPath(), "rb");
            while (!$status && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);
            }
            fclose($handle);
            $this->client->setDefer(false);
            
        } catch (Google_Service_Exception $e) {
            $error = '<p>A service error occurred: '.$e->getMessage();
        } catch (Google_Exception $e) {
            $error = '<p>An client error occurred: '.$e->getMessage();
        }
        
        return $error;
    }

    public function search($keyword, $category_id) {
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
