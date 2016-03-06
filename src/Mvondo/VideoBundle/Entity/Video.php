<?php

namespace Mvondo\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mvondo\VideoBundle\Entity\VideoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Video {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Origin
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\VideoBundle\Entity\Origin")
     * @ORM\JoinColumn(nullable = false)
     */
    private $origin;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", inversedBy="videos")
     * @ORM\JoinColumn(nullable = false)
     */
    private $user;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Mvondo\VideoBundle\Entity\Category",  inversedBy="videos")
     */
    private $categories;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\SiteBundle\Entity\Country", inversedBy="videos")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=10)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="player_key", type="string", length=255)
     */
    private $playerKey;

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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="signaled", type="boolean")
     */
    private $signaled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * @var file
     * 
     * @Assert\NotBlank(message="Please, upload the video.")
     */
    private $file;

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
     * @return Video
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
     * @return Video
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
     * Set playerKey
     *
     * @param string $playerKey
     * @return Video
     */
    public function setPlayerKey($playerKey) {
        $this->playerKey = $playerKey;

        return $this;
    }

    /**
     * Get playerKey
     *
     * @return string 
     */
    public function getPlayerKey() {
        return $this->playerKey;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Video
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
     * @return Video
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
     * Set status
     *
     * @param boolean $status
     * @return Video
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set signaled
     *
     * @param boolean $signaled
     * @return Video
     */
    public function setSignaled($signaled) {
        $this->signaled = $signaled;

        return $this;
    }

    /**
     * Get signaled
     *
     * @return boolean 
     */
    public function getSignaled() {
        return $this->signaled;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Video
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted() {
        return $this->deleted;
    }

    /**
     * Set origin
     *
     * @param \Mvondo\VideoBundle\Entity\Origin $origin
     * @return Video
     */
    public function setOrigin(\Mvondo\VideoBundle\Entity\Origin $origin) {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return \Mvondo\VideoBundle\Entity\Origin 
     */
    public function getOrigin() {
        return $this->origin;
    }

    /**
     * Set country
     *
     * @param \Mvondo\SiteBundle\Entity\Country $country
     * @return Video
     */
    public function setCountry(\Mvondo\SiteBundle\Entity\Country $country = null) {
        $this->country = $country;
        $country->addVideo($this);
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
     * Constructor
     */
    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateAdd = new \DateTime();
        $this->dateUp = new \DateTime();
        $this->status = true;
        $this->signaled = FALSE;
        $this->deleted = FALSE;
    }

    /**
     * Add categories
     *
     * @param \Mvondo\VideoBundle\Entity\Category $categories
     * @return Video
     */
    public function addCategory(\Mvondo\VideoBundle\Entity\Category $categories) {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Mvondo\VideoBundle\Entity\Category $categories
     */
    public function removeCategory(\Mvondo\VideoBundle\Entity\Category $categories) {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Video
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set user
     *
     * @param \Mvondo\UserBundle\Entity\User $user
     * @return Video
     */
    public function setUser(\Mvondo\UserBundle\Entity\User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Mvondo\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
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

    /**
     * Set image
     *
     * @param string $image
     * @return Video
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Video
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Get file
     * 
     * @return file 
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set file
     * 
     * @param Uploadedfile $file 
     * @return Video 
     */
    public function setFile($file) {
        $this->file = $file;

        return $this;
    }

    /**
     * Upload file
     * 
     * @return boolean 
     */
    public function Upload() {
        if ($this->file == null)
            return false;

        $name = $this->getFilename();
        if (file_exists($this->getUploadRootDir() . '/' . $name))
            unlink($this->getUploadRootDir() . '/' . $name);

        $this->file->move($this->getUploadRootDir(), $name);
    }

    /**
     * get upload directory from bundle directory
     * 
     * @return string
     */
    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/uploads/temp';
    }

    
    /**
     * get upload file path
     * 
     * @return string
     */
    public function getPath() {
        return $this->getUploadRootDir() . '/'.$this->getFilename();
    }
    
    /**
     * get upload directory from bundle directory
     * 
     * @return string
     */
    public function getFilename() {
        return $this->user->getUsername() . '_temp_video2.mp4' ;//. $this->file->guessExtension();
    }

    /**
     * get upload directory from web directory
     * 
     * @return string
     */
    public function deleteFile() {
        $name = $this->getFilename();
        if (file_exists($this->getUploadRootDir() . '/' . $name))
            unlink($this->getUploadRootDir() . '/' . $name);
    }

    /**
     * get upload directory from web directory
     * 
     * @return string
     */
    public function getUploadDir() {
        return 'uploads/temp';
    }

}
