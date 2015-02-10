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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_ar", type="text", nullable=true)
     */
    private $description_ar;

    /**
     * @var string
     *
     * 
     * @ORM\OneToMany(targetEntity="Dalilak\VenueBundle\Entity\Image", mappedBy="album" ,cascade={"persist"})
     */
    private $images;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Venue",inversedBy="albums")
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
    public function getImagesAsArray($request) {
        $images = array();
        foreach ($this->images as $image) {
            $images[] = $image->toArray($request);
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
    public function addImage(\Dalilak\VenueBundle\Entity\Image $img) {
        $this->images[] = $img;

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
    public function getImages() {
        return $this->images;
    }

    public function toArray($params){
        if(!isset($params['lang'])) {
            $params['lang'] = 'en';
        }

        return array(
            'id' => $this->id,
            'venue_id' => $this->getVenue()->getId(),
            'description' => $this->getDescription($param['lang']),
            'images' => $this->getImagesAsArray(array('request' => $params['request']))
        );
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Album
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription($lang = 'en') {
        if($lang == 'ar')
            return $this->description_ar;
        return $this->description;
    }

    /**
     * Set description_ar
     *
     * @param string $descriptionAr
     * @return Album
     */
    public function setDescriptionAr($descriptionAr)
    {
        $this->description_ar = $descriptionAr;

        return $this;
    }

    /**
     * Get description_ar
     *
     * @return string 
     */
    public function getDescriptionAr()
    {
        return $this->description_ar;
    }
}
