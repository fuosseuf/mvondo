<?php

namespace Mvondo\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mvondo\VideoBundle\Entity\CategoryRepository")
 */
class Category {

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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Mvondo\SiteBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Mvondo\VideoBundle\Entity\Video",  mappedBy="categories")
     */
    private $videos;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\VideoBundle\Entity\Category")
     */
    private $parent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
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
     * Set image
     *
     * @param \Mvondo\SiteBundle\Entity\Image $image
     * @return Category
     */
    public function setImage(\Mvondo\SiteBundle\Entity\Image $image = null) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Mvondo\SiteBundle\Entity\Image 
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set parent
     *
     * @param \Mvondo\VideoBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\Mvondo\VideoBundle\Entity\Category $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Mvondo\VideoBundle\Entity\Category 
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add videos
     *
     * @param \Mvondo\VideoBundle\Entity\Video $videos
     * @return Category
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
     * Set slug
     *
     * @param string $slug
     * @return Category
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

}
