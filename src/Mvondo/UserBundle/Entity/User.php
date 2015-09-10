<?php

namespace Mvondo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="mvondo_users")
 * @ORM\Entity(repositoryClass="Mvondo\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\Group", inversedBy="users")
     */
    private $group;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Mvondo\SiteBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @var country
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\SiteBundle\Entity\Country", inversedBy="users")
     */
    private $country;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\VideoBundle\Entity\Video", mappedBy="user")
     */
    private $videos;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\UserBundle\Entity\Followers", mappedBy="artist")
     */
    private $fans;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Mvondo\UserBundle\Entity\Followers", mappedBy="fan")
     */
    private $artists;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_up", type="datetime")
     */
    private $dateUp;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->dateAdd = new \DateTime();
        $this->dateUp = new \DateTime();
        $this->fans = new \Doctrine\Common\Collections\ArrayCollection();
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return User
     */
    public function setBiography($biography) {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography() {
        return $this->biography;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return User
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
     * @return User
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
     * Set profil
     *
     * @param \Mvondo\SiteBundle\Entity\Image $profil
     * @return User
     */
    public function setProfil(\Mvondo\SiteBundle\Entity\Image $profil = null) {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \Mvondo\SiteBundle\Entity\Image 
     */
    public function getProfil() {
        return $this->profil;
    }

    /**
     * Set country
     *
     * @param \Mvondo\SiteBundle\Entity\Country $country
     * @return User
     */
    public function setCountry(\Mvondo\SiteBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Mvondo\SiteBundle\Entity\Country 
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Add fans
     *
     * @param \Mvondo\UserBundle\Entity\Followers $fans
     * @return User
     */
    public function addFan(\Mvondo\UserBundle\Entity\Followers $fans) {
        $this->fans[] = $fans;

        return $this;
    }

    /**
     * Remove fans
     *
     * @param \Mvondo\UserBundle\Entity\Followers $fans
     */
    public function removeFan(\Mvondo\UserBundle\Entity\Followers $fans) {
        $this->fans->removeElement($fans);
    }

    /**
     * Get fans
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFans() {
        return $this->fans;
    }

    /**
     * Add artists
     *
     * @param \Mvondo\UserBundle\Entity\Followers $artists
     * @return User
     */
    public function addArtist(\Mvondo\UserBundle\Entity\Followers $artists) {
        $this->artists[] = $artists;

        return $this;
    }

    /**
     * Remove artists
     *
     * @param \Mvondo\UserBundle\Entity\Followers $artists
     */
    public function removeArtist(\Mvondo\UserBundle\Entity\Followers $artists) {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtists() {
        return $this->artists;
    }

    /**
     * Set group
     *
     * @param \Mvondo\UserBundle\Entity\Group $group
     * @return User
     */
    public function setGroup(\Mvondo\UserBundle\Entity\Group $group = null) {
        $this->group = $group;
        $this->setRoles($this->group->getRoles());

        return $this;
    }

    /**
     * Get group
     *
     * @return \Mvondo\UserBundle\Entity\Group 
     */
    public function getGroup() {
        return $this->group;
    }

    /**
     * Add videos
     *
     * @param \Mvondo\VideoBundle\Entity\Video $videos
     * @return User
     */
    public function addVideo(\Mvondo\VideoBundle\Entity\Video $videos) {
        $this->videos[] = $videos;

        return $this;
    }

    /**
     * Remove videos
     *
     * @param \Mvondo\VideoBundle\Entity\Video $videos
     */
    public function removeVideo(\Mvondo\VideoBundle\Entity\Video $videos) {
        $this->videos->removeElement($videos);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideos() {
        return $this->videos;
    }

    /**
     * update dateAdd
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateDateUp() {
        $this->dateUp = new \DateTime();
    }

}
