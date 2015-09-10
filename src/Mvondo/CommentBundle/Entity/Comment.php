<?php

namespace Mvondo\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mvondo\VideoBundle\Entity\Video;

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
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Mvondo\VideoBundle\Entity\Video", cascade={"persist"})
     */
    private $video;
    
    /**
     * @ORM\OneToMany(targetEntity="Mvondo\CommentBundle\Entity\Comment", cascade={"persist"}, mappedBy="parent")
     */
    private $parent;


    /**
     * get video
     * 
     * @return Video
     */
    function getVideo() {
        return $this->video;
    }

    /**
     * get parent comment
     * 
     * @return Comment
     */
    function getParent() {
        return $this->parent;
    }

    /**
     * set video
     * 
     * @param Video $video
     */
    function setVideo($video) {
        $this->video = $video;
    }
    
    
    /**
     * 
     * Set parent
     * @param Comment $parent
     */
    function setParent($parent) {
        $this->parent = $parent;
    }

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
     * @param integer $status
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
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
