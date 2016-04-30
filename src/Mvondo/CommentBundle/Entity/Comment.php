<?php

namespace Mvondo\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mvondo\VideoBundle\Entity\Video as Video;
use Mvondo\UserBundle\Entity\User;
/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mvondo\CommentBundle\Entity\CommentRepository")
 */
class Comment
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
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\VideoBundle\Entity\Video", cascade={"persist"})
     */
    private $video;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\CommentBundle\Entity\Comment", cascade={"persist"})
     */
    private $parent;
    
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
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Comment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Get video
     * 
     * @return Video
     */
    public function getVideo() {
        return $this->video;
    }

    /**
     * Set video
     * 
     * @param \Video $video
     * @return Comment
     */
    public function setVideo($video) {
        $this->video = $video;
        return $this;
    }
    
    /**
     * Get parent
     * 
     * @return Comment
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Set parent
     * 
     * @param Comment $parent
     * @return Comment
     */
    function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function __construct() {
        $this->date = new \DateTime();
        $this->status = true;
    }


    /**
     * Get user
     * 
     * @return User
     */
    function getUser() {
        return $this->user;
    }

    /**
     * Set user
     * 
     * @param User $user
     * @return \Mvondo\CommentBundle\Entity\Comment
     */
    function setUser($user) {
        $this->user = $user;
        return $this;
    }


}
