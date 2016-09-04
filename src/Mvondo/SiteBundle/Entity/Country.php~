<?php

namespace Mvondo\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Country
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
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\VideoBundle\Entity\Video", mappedBy="country")
     */
    private $videos;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\EventBundle\Entity\Event", mappedBy="country")
     */
    private $events;
    
            /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\UserBundle\Entity\User", mappedBy="country")
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code", type="string", length=3)
     */
    private $isoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

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
     * Set isoCode
     *
     * @param string $isoCode
     * @return Country
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add video
     *
     * @param \Mvondo\VideoBundle\Entity\Video $video
     * @return Country
     */
    public function addVideo(\Mvondo\VideoBundle\Entity\Video $video)
    {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Mvondo\VideoBundle\Entity\Video $video
     */
    public function removeVideo(\Mvondo\VideoBundle\Entity\Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Add users
     *
     * @param \Mvondo\UserBundle\Entity\User $users
     * @return Country
     */
    public function addUser(\Mvondo\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Mvondo\UserBundle\Entity\User $users
     */
    public function removeUser(\Mvondo\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    /**
     * Add events
     *
     * @param \Mvondo\EventBundle\Entity\Event $events
     * @return Country
     */
    public function addEvent(\Mvondo\EventBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Mvondo\EventBundle\Entity\Event $events
     */
    public function removeEvent(\Mvondo\EventBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
