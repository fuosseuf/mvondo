<?php

namespace Mvondo\YoutubeBundle\Service;

class GoogleClient extends \Google_Client{
    
        public function __construct(  $devKey, $clientId, $clientSecret, $scope) {
        
        parent::__construct();
        $this->setDeveloperKey($devKey);
        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
        $this->setScopes($scope);
    }
}
