<?php

namespace Mvondo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Followers
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Followers {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")  
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var array
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", inversedBy="artists")
     * @ORM\JoinColumn(nullable = false)
     */
    private $fan;

    /**
     * @var array
     *
     * @ORM\ManyToOne(targetEntity="Mvondo\UserBundle\Entity\User", inversedBy="fans")
     * @ORM\JoinColumn(nullable = false)
     */
    private $artist;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Followers
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
     * Set fan
     *
     * @param \Mvondo\UserBundle\Entity\User $fan
     * @return Followers
     */
    public function setFan(\Mvondo\UserBundle\Entity\User $fan)
    {
        $this->fan = $fan;

        return $this;
    }

    /**
     * Get fan
     *
     * @return \Mvondo\UserBundle\Entity\User 
     */
    public function getFan()
    {
        return $this->fan;
    }

    /**
     * Set artist
     *
     * @param \Mvondo\UserBundle\Entity\User $artist
     * @return Followers
     */
    public function setArtist(\Mvondo\UserBundle\Entity\User $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Mvondo\UserBundle\Entity\User 
     */
    public function getArtist()
    {
        return $this->artist;
    }
}
