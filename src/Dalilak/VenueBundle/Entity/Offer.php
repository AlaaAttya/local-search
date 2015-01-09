<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 *
 * @ORM\Table(name="offers")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\OfferRepository")
 */
class Offer {

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_date", type="date")
     */
    private $validDate;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=255)
     */
    private $vendor;

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
     * @return Offer
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
     * Set validDate
     *
     * @param \DateTime $validDate
     * @return Offer
     */
    public function setValidDate($validDate) {
        $this->validDate = $validDate;

        return $this;
    }

    /**
     * Get validDate
     *
     * @return \DateTime 
     */
    public function getValidDate() {
        return $this->validDate;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Offer
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
     * Set vendor
     *
     * @param string $vendor
     * @return Offer
     */
    public function setVendor($vendor) {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string 
     */
    public function getVendor() {
        return $this->vendor;
    }

    /**
     * populate an object to array
     */
    public function toArray() {
        return array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'vendor' => $this->getVendor(),
            'valid_date' => $this->getValidDate(),
            'image' => $this->getImage()
        );
    }

}
