<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VenuePhone
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 *
 * @ORM\Table(name="venue_phones")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\VenuePhoneRepository")
 */
class VenuePhone {

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
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var Venue
     *
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Venue")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id")
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
     * Set number
     *
     * @param string $number
     * @return VenuePhone
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set venue
     *
     * @param \Dalilak\VenueBundle\Entity\Venue $venue
     * @return VenuePhone
     */
    public function setVenue(\Dalilak\VenueBundle\Entity\Venue $venue = null) {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \Dalilak\VenueBundle\Entity\Venue 
     */
    public function getVenue() {
        return $this->venue;
    }
    
    public function toArray(){
        $phone = array(
            'id'=>  $this->id,
            'number'=>  $this->number
        );
        
        return $phone;
    }
}
