<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ad
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 *
 * @ORM\Table(name="ads")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\AdRepository")
 */
class Ad
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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="text_ar", type="string", length=255)
     */
    private $textAr;

    /**
     * @var Category
     * @ORM\OneToOne(targetEntity="Dalilak\VenueBundle\Entity\Category")
     */
    private $category;

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
     * Set image
     *
     * @param string $image
     * @return Ad
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage($request) {
        $image = $this->__getAdsUploadPath() . $this->image;
        $image_full_url = str_replace('/app_dev.php', '', $request->getUriForPath($image));
        return $image_full_url;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Ad
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText($lang = 'en') {
        if($lang == 'ar')
            return $this->text_ar;
        return $this->text;
    }

    /**
     * Set textAr
     *
     * @param string $textAr
     * @return Ad
     */
    public function setTextAr($textAr)
    {
        $this->textAr = $textAr;

        return $this;
    }

    /**
     * Get textAr
     *
     * @return string 
     */
    public function getTextAr()
    {
        return $this->textAr;
    }
    

    /**
     * Set category
     *
     * @param \Dalilak\VenueBundle\Entity\Category $category
     * @return Ad
     */
    public function setCategory(\Dalilak\VenueBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Dalilak\VenueBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    protected function __getAdsUploadPath(){
        return '/uploads/ads/';
    }


    public function toArray($params){
        return array(
            'id' => $this->id,
            'image' => $this->getImage($params['request']),
            'text' => $this->getText($params['lang']),
            'category' => array(
                'title' => $this->getCategory()->getTitle(),
                'alias' => $this->getCategory()->getAlias()
            )
        );
    }
}
