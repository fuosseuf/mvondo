<?php

namespace Mvondo\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Mvondo\VideoBundle\Entity\Video as Video;
use Mvondo\UserBundle\Entity\User;


/**
 * Kiff
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mvondo\CommentBundle\Entity\KiffRepository")
 */
class Kiff
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\VideoBundle\Entity\Video", cascade={"persist"})
     */
    private $video;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get User
     * 
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * get Video
     * 
     * @return Video
     */
    public function getVideo() {
        return $this->video;
    }

    /**
     * Set user
     * 
     * @param User $user
     * @return \Mvondo\CommentBundle\Entity\Kiff
     */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    /**
     * Set Video
     * 
     * @param Video $video
     * @return \Mvondo\CommentBundle\Entity\Kiff
     */
    public function setVideo($video) {
        $this->video = $video;
        return $this;
    }
    

}
