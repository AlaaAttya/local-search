<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Venue
 *
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 * 
 * @ORM\Table(name="venues")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\VenueRepository")
 */
class Venue {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_ar", type="string", length=255)
     */
    private $nameAr;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * 
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="opening_times", type="string", length=255)
     */
    private $openingTimes;

    /**
     * @var string
     *
     * @ORM\Column(name="offers", type="string", length=255)
     */
    private $offers;

    /**
     * @var string
     *
     * @ORM\Column(name="services", type="text")
     */
    private $services;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Dalilak\VenueBundle\Entity\VenuePhone", mappedBy="venue" ,cascade={"all"})
     */
    private $phones;

    /**
     * @var ArrayCollection 
     * 
     * @ORM\ManyToMany(targetEntity="Dalilak\VenueBundle\Entity\Category", inversedBy="venues")
     * @ORM\JoinTable(name="venues_categories",
     *      joinColumns={@ORM\JoinColumn(name="venue_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     * */
    private $categories;

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
     * @return Venue
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
     * Set nameAr
     *
     * @param string $nameAr
     * @return Venue
     */
    public function setNameAr($nameAr) {
        $this->nameAr = $nameAr;

        return $this;
    }

    /**
     * Get nameAr
     *
     * @return string 
     */
    public function getNameAr() {
        return $this->nameAr;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Venue
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Venue
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Venue
     */
    public function setFacebook($facebook) {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook() {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Venue
     */
    public function setTwitter($twitter) {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter() {
        return $this->twitter;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Venue
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set openingTimes
     *
     * @param string $openingTimes
     * @return Venue
     */
    public function setOpeningTimes($openingTimes) {
        $this->openingTimes = $openingTimes;

        return $this;
    }

    /**
     * Get openingTimes
     *
     * @return string 
     */
    public function getOpeningTimes() {
        return $this->openingTimes;
    }

    /**
     * Set offers
     *
     * @param string $offers
     * @return Venue
     */
    public function setOffers($offers) {
        $this->offers = $offers;

        return $this;
    }

    /**
     * Get offers
     *
     * @return string 
     */
    public function getOffers() {
        return $this->offers;
    }

    /**
     * Set services
     *
     * @param string $services
     * @return Venue
     */
    public function setServices($services) {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return string 
     */
    public function getServices() {
        return $this->services;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Venue
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add phones
     *
     * @param \Dalilak\VenueBundle\Entity\VenuePhone $phones
     * @return Venue
     */
    public function addPhone(\Dalilak\VenueBundle\Entity\VenuePhone $phones) {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \Dalilak\VenueBundle\Entity\VenuePhone $phones
     */
    public function removePhone(\Dalilak\VenueBundle\Entity\VenuePhone $phones) {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones() {
        return $this->phones;
    }

    /**
     * Return phones as array
     * 
     * @return array
     */
    public function getPhonesAsArray() {
        $phones = array();
        foreach ($this->phones as $phone) {
            $phone[] = $phone->toArray();
        }
        return $phones;
    }

    /**
     * Add categories
     *
     * @param \Dalilak\VenueBundle\Entity\Category $categories
     * @return Venue
     */
    public function addCategory(\Dalilak\VenueBundle\Entity\Category $categories) {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Dalilak\VenueBundle\Entity\Category $categories
     */
    public function removeCategory(\Dalilak\VenueBundle\Entity\Category $categories) {
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
     * Get categories as Array
     * 
     * @return array
     */
    public function getCategoriesAsArray() {
        $categories = array();
        foreach ($this->categories as $category) {
            $categories[] = $category->toArray();
        }
        return $categories;
    }

    public function __toString() {
        return $this->name;
    }

        /**
     * Retuen array representation of the current object
     * @access public
     * 
     * @return array
     */
    public function toArray() {
        $venue = array(
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->nameAr,
            'email' => $this->email,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'offers' => $this->offers,
            'address'=> isset($this->address)&&!empty($this->address)? $this->address->toArray() : array(),
            'opening_times' => $this->openingTimes,
            'services' => $this->services,
            'categories' => $this->getCategoriesAsArray(),
            'phones' => $this->getPhonesAsArray()
        );
        return $venue;
    }
}
