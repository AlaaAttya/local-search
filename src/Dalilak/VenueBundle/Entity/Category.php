<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *  
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 * 
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\CategoryRepository")
 */
class Category {

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
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var ArrayCollection 
     * @ORM\ManyToMany(targetEntity="Dalilak\VenueBundle\Entity\Venue", mappedBy="categories")
     * */
    private $venues;

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
     * @return Category
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
     * Set alias
     *
     * @param string $alias
     * @return Category
     */
    public function setAlias($alias) {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias() {
        return $this->alias;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->venues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add venues
     *
     * @param \Dalilak\VenueBundle\Entity\Venue $venues
     * @return Category
     */
    public function addVenue(\Dalilak\VenueBundle\Entity\Venue $venues) {
        $this->venues[] = $venues;

        return $this;
    }

    /**
     * Remove venues
     *
     * @param \Dalilak\VenueBundle\Entity\Venue $venues
     */
    public function removeVenue(\Dalilak\VenueBundle\Entity\Venue $venues) {
        $this->venues->removeElement($venues);
    }

    /**
     * Get venues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVenues() {
        return $this->venues;
    }

    public function __toString() {
        return $this->title;
    }

    /**
     * Retuen array representation of the current object
     */
    public function toArray() {
        $category = array(
            'id' => $this->id,
            'alias' => $this->alias,
            'title' => $this->title
        );
        return $category;
    }

}
