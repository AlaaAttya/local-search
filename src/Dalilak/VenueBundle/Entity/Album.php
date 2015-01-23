<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 *
 * @ORM\Table(name="albums")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\AlbumRepository")
 */
class Album
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
     * 
     * @ORM\OneToMany(targetEntity="Dalilak\VenueBundle\Entity\Image", mappedBy="album" ,cascade={"persist"})
     */
    private $images;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Venue",inversedBy="branches")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $venue;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set venue
     *
     * @param string $venue
     * @return Album
     */
    public function setVenue($venue) {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string 
     */
    public function getVenue() {
        return $this->venue;
    }

    /**
     * Return images as array
     * 
     * @return array
     */
    public function getImagesAsArray() {
        $images = array();
        foreach ($this->images as $image) {
            $images[] = $image->toArray();
        }
        return $images;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param \Dalilak\VenueBundle\Entity\Image $images
     * @return Album
     */
    public function addImage(\Dalilak\VenueBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Dalilak\VenueBundle\Entity\Image $images
     */
    public function removeImage(\Dalilak\VenueBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
