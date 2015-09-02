<?php

namespace Mvondo\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Origin
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Origin
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="WSaccount", type="string", length=100)
     */
    private $wSaccount;

    /**
     * @var string
     *
     * @ORM\Column(name="WSkey", type="string", length=255)
     */
    private $wSkey;


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
     * Set name
     *
     * @param string $name
     * @return Origin
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
     * Set wSaccount
     *
     * @param string $wSaccount
     * @return Origin
     */
    public function setWSaccount($wSaccount)
    {
        $this->wSaccount = $wSaccount;

        return $this;
    }

    /**
     * Get wSaccount
     *
     * @return string 
     */
    public function getWSaccount()
    {
        return $this->wSaccount;
    }

    /**
     * Set wSkey
     *
     * @param string $wSkey
     * @return Origin
     */
    public function setWSkey($wSkey)
    {
        $this->wSkey = $wSkey;

        return $this;
    }

    /**
     * Get wSkey
     *
     * @return string 
     */
    public function getWSkey()
    {
        return $this->wSkey;
    }
}
