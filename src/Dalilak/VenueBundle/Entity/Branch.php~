<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Branch
 *
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 * 
 * @ORM\Table(name="branches")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\BranchRepository")
 */
class Branch {

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
     * @ORM\Column(name="area", type="string", length=255)
     */
    private $area;

    /**
     * @var Address
     *
     * @ORM\OneToOne(targetEntity="Dalilak\VenueBundle\Entity\Address")
     */
    //private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address_longitude", type="string", length=255)
     */
    private $address_longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="address_latitude", type="string", length=255)
     */
    private $address_latitude;

    /**
     * @var string
     * 
     * @ORM\Column(name="address_text", type="text")
     */
    private $address_text;

    
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
     * Set area
     *
     * @param string $area
     * @return Branch
     */
    public function setArea($area) {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string 
     */
    public function getArea() {
        return $this->area;
    }

    /**
     * Set address
     *
     * @param Address $address
     * @return Branch
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return Address 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set venue
     *
     * @param integer $venue
     * @return Branch
     */
    public function setVenue($venue) {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return integer 
     */
    public function getVenue() {
        return $this->venue;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Address
     */
    public function setAddressLongitude($longitude) {
        $this->address_longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getAddressLongitude() {
        return $this->address_longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Address
     */
    public function setAddressLatitude($latitude) {
        $this->address_latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getAddressLatitude() {
        return $this->address_latitude;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Address
     */
    public function setAddressText($text) {
        $this->address_text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getAddressText() {
        return $this->address_text;
    }

    /**
     * Populate a barnch as an array
     * 
     * @access public
     * @return array
     */
    public function toArray() {
        $branch = array(
            'id' => $this->getId(),
            'area' => $this->getArea(),
            'address' => array(
                'text' => $this->getAddressText(),
                'latitude' => $this->getAddressLatitude(),
                'logitude' => $this->getAddressLongitude()
            )
        );
        return $branch;
    }

}
