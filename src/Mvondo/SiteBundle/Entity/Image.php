<?php

namespace Mvondo\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var gallery
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\EventBundle\Entity\Gallery", inversedBy="images")
     */
    private $gallery;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var file
     */
    private $file;
    private $tempfile;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
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
     * @return Image 
     */
    public function setFile(\Symfony\Component\HttpFoundation\File\UploadedFile $file) {
        $this->file = $file;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function preUpload() {
        if ($this->file == null)
            return false;

        $this->title = $this->file->getClientOriginalName();
        $this->path = $this->file->guessExtension();
    }

    /**
     * Upload file
     * 
     * @ORM\PostUpdate()
     * @ORM\PostPersist()
     * 
     * @return boolean 
     */
    public function Upload() {
        if ($this->file == null)
            return false;

        $name = $this->id . '.' . $this->path;
        if (file_exists($this->getUploadRootDir() . '/' . $name))
            unlink($this->getUploadRootDir() . '/' . $name);

        $this->file->move($this->getUploadRootDir(), $name);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemove() {
        $this->tempfile = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->path;
    }

    /**
     * @ORM\PostRemove()
     */
    public function postRemove() {
        unlink($this->tempfile);
    }

    /**
     * get upload directory from web directory
     * 
     * @return string
     */
    public function getUploadDir() {
        return 'uploads/img';
    }

    /**
     * get upload directory from bundle directory
     * 
     * @return string
     */
    protected function getUploadRootDir() {
        return __DIR__ . '/../../../../web/uploads/img';
    }

    /**
     * get weblink
     * 
     * @return string
     */
    public function getWeblink() {
        return '../' . $this->getUploadDir() . '/' . $this->id . '.' . $this->path;
    }


    /**
     * Set gallery
     *
     * @param \Mvondo\EventBundle\Entity\Gallery $gallery
     * @return Image
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
}
