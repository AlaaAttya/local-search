<?php

namespace Dalilak\PublicServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.PublicServicesBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 * 
 * @ORM\Table(name="phones")
 * @ORM\Entity(repositoryClass="Dalilak\PublicServicesBundle\Repository\PhoneRepository")
 */
class Phone {

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
     * @ORM\Column(name="title_ar", type="string", length=255)
     */
    private $title_ar;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

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
     * @return Phone
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
    public function getTitle($lang = 'en') {
        if($lang == 'ar')
            return $this->title_ar;
        return $this->title;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Phone
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
     * Set title_ar
     *
     * @param string $titleAr
     * @return Category
     */
    public function setTitleAr($titleAr) {
        $this->title_ar = $titleAr;

        return $this;
    }

    /**
     * Get title_ar
     *
     * @return string 
     */
    public function getTitleAr() {
        return $this->title_ar;
    }

    public function toArray($params = array()) {

        if(!isset($params['lang']) || empty($params['lang'])){
            $params['lang'] = 'en';
        }

        return array(
            'title' => $this->getTitle($params['lang']),
            'number' => $this->number
        );
    }

}
