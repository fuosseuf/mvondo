<?php

namespace Mvondo\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mvondo\EventBundle\Entity\EventRepository")
 */
class Event {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(nullable = false)
     */
    private $user;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Mvondo\SiteBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $flyer;

    /**
     * @var country
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\SiteBundle\Entity\Country", inversedBy="events")
     */
    private $country;
    
        /**
     * @var gallery
     *
     * @ORM\OneToOne(targetEntity="Mvondo\EventBundle\Entity\Gallery", cascade={"persist", "remove"})
     */
    private $gallery;

            /**
     * @var type
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\EventBundle\Entity\TypeEvent", inversedBy="events")
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @ORM\JoinColumn(nullable = false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="date")
     */
    private $dateEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdd", type="datetime")
     */
    private $dateAdd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUp", type="datetime")
     */
    private $dateUp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour", type="time")
     */
    private $hour;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;
    
        /**
     * @var boolean
     *
     * @ORM\Column(name="canceled", type="boolean")
     */
    private $canceled;
    

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="text", nullable=true)
     */
    private $website;
    
        /**
     * Constructor
     */
    public function __construct() {
        $this->dateAdd = new \DateTime();
        $this->dateUp = new \DateTime();
        $this->canceled = FALSE;
    }
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     * @return Event
     */
    public function setDateEvent($dateEvent) {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime 
     */
    public function getDateEvent() {
        return $this->dateEvent;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Event
     */
    public function setDateAdd($dateAdd) {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime 
     */
    public function getDateAdd() {
        return $this->dateAdd;
    }

    /**
     * Set dateUp
     *
     * @param \DateTime $dateUp
     * @return Event
     */
    public function setDateUp($dateUp) {
        $this->dateUp = $dateUp;

        return $this;
    }

    /**
     * Get dateUp
     *
     * @return \DateTime 
     */
    public function getDateUp() {
        return $this->dateUp;
    }

    /**
     * Set hour
     *
     * @param \DateTime $hour
     * @return Event
     */
    public function setHour($hour) {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return \DateTime 
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Event
     */
    public function setContact($contact) {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact() {
        return $this->contact;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Event
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite() {
        return $this->website;
    }


    /**
     * Set user
     *
     * @param \Mvondo\UserBundle\Entity\User $user
     * @return Event
     */
    public function setUser(\Mvondo\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Mvondo\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set flyer
     *
     * @param \Mvondo\SiteBundle\Entity\Image $flyer
     * @return Event
     */
    public function setFlyer(\Mvondo\SiteBundle\Entity\Image $flyer = null)
    {
        $this->flyer = $flyer;

        return $this;
    }

    /**
     * Get flyer
     *
     * @return \Mvondo\SiteBundle\Entity\Image 
     */
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * Set country
     *
     * @param \Mvondo\SiteBundle\Entity\Country $country
     * @return Event
     */
    public function setCountry(\Mvondo\SiteBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Mvondo\SiteBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set type
     *
     * @param \Mvondo\EventBundle\Entity\TypeEvent $type
     * @return Event
     */
    public function setType(\Mvondo\EventBundle\Entity\TypeEvent $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Mvondo\EventBundle\Entity\TypeEvent 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set gallery
     *
     * @param \Mvondo\EventBundle\Entity\Gallery $gallery
     * @return Event
     */
    public function setGallery(\Mvondo\EventBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Mvondo\EventBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set canceled
     *
     * @param boolean $canceled
     * @return Event
     */
    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;

        return $this;
    }

    /**
     * Get canceled
     *
     * @return boolean 
     */
    public function getCanceled()
    {
        return $this->canceled;
    }
}
