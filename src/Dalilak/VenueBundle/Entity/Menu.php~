<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table("menus")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\BranchRepository")
 */
class Menu {

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
     * @ORM\Column(name="item_name", type="string", length=255, nullable=true)
     */
    private $item_name;

    /**
     * @var string
     *
     * @ORM\Column(name="ingerdients", type="string", length=255, nullable=true)
     */
    private $ingerdients;

    /**
     * @var string
     *
     * @ORM\Column(name="size1", type="string", length=255, nullable=true)
     */
    private $size1;

    /**
     * @var string
     *
     * @ORM\Column(name="size1_price", type="string", length=255, nullable=true)
     */
    private $size1_price;

    /**
     * @var string
     *
     * @ORM\Column(name="size2", type="string", length=255, nullable=true)
     */
    private $size2;

    /**
     * @var string
     *
     * @ORM\Column(name="size2_price", type="string", length=255, nullable=true)
     */
    private $size2_price;

    /**
     * @var string
     *
     * @ORM\Column(name="size3", type="string", length=255, nullable=true)
     */
    private $size3;

    /**
     * @var string
     *
     * @ORM\Column(name="size3_price", type="string", length=255, nullable=true)
     */
    private $size3_price;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Venue",inversedBy="menus")
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
     * Set item_name
     *
     * @param string $itemName
     * @return Menu
     */
    public function setItemName($itemName) {
        $this->item_name = $itemName;

        return $this;
    }

    /**
     * Get item_name
     *
     * @return string 
     */
    public function getItemName() {
        return $this->item_name;
    }

    /**
     * Set ingerdients
     *
     * @param string $ingerdients
     * @return Menu
     */
    public function setIngerdients($ingerdients) {
        $this->ingerdients = $ingerdients;

        return $this;
    }

    /**
     * Get ingerdients
     *
     * @return string 
     */
    public function getIngerdients() {
        return $this->ingerdients;
    }

    /**
     * Set size1
     *
     * @param string $size1
     * @return Menu
     */
    public function setSize1($size1) {
        $this->size1 = $size1;

        return $this;
    }

    /**
     * Get size1
     *
     * @return string 
     */
    public function getSize1() {
        return $this->size1;
    }

    /**
     * Set size1_price
     *
     * @param string $size1Price
     * @return Menu
     */
    public function setSize1Price($size1Price) {
        $this->size1_price = $size1Price;

        return $this;
    }

    /**
     * Get size1_price
     *
     * @return string 
     */
    public function getSize1Price() {
        return $this->size1_price;
    }

    /**
     * Set size2
     *
     * @param string $size2
     * @return Menu
     */
    public function setSize2($size2) {
        $this->size2 = $size2;

        return $this;
    }

    /**
     * Get size2
     *
     * @return string 
     */
    public function getSize2() {
        return $this->size2;
    }

    /**
     * Set size2_price
     *
     * @param string $size2Price
     * @return Menu
     */
    public function setSize2Price($size2Price) {
        $this->size2_price = $size2Price;

        return $this;
    }

    /**
     * Get size2_price
     *
     * @return string 
     */
    public function getSize2Price() {
        return $this->size2_price;
    }

    /**
     * Set size3
     *
     * @param string $size3
     * @return Menu
     */
    public function setSize3($size3) {
        $this->size3 = $size3;

        return $this;
    }

    /**
     * Get size3
     *
     * @return string 
     */
    public function getSize3() {
        return $this->size3;
    }

    /**
     * Set size3_price
     *
     * @param string $size3Price
     * @return Menu
     */
    public function setSize3Price($size3Price) {
        $this->size3_price = $size3Price;

        return $this;
    }

    /**
     * Get size3_price
     *
     * @return string 
     */
    public function getSize3Price() {
        return $this->size3_price;
    }

    /**
     * Set venue
     *
     * @param \Dalilak\VenueBundle\Entity\Venue $venue
     * @return Menu
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

    /**
     * Polulate menu object as an array
     * 
     * @return array
     */
    public function toArray($hasVenue = false) {
        $menuArray = array(
            'id' => $this->getId(),
            'item_name' => $this->getItemName(),
            'ingredients' => $this->getIngerdients(),
            'size1' => $this->getSize1(),
            'size1_price' => $this->getSize1Price(),
            'size2' => $this->getSize2(),
            'size2_price' => $this->getSize2Price(),
            'size3' => $this->getSize3(),
            'size3_price' => $this->getSize3Price()
        );
        
        if($hasVenue){
            $menuArray['venue'] = $this->getVenue()->toArray();
        }
        
        return $menuArray;
    }

}
