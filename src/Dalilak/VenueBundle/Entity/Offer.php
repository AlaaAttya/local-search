<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;

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
     * @var string
     *
     * @ORM\Column(name="title_ar", type="string", length=255, nullable=true)
     */
    private $title_ar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_date", type="date")
     */
    private $validDate;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

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
     * Get the offer vendor (Venue)
     * 
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Venue",inversedBy="offers")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $vendor;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $imageFile;

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
     * @param   string $lang
     * @return string 
     */
    public function getTitle($lang = 'en') {
        if($lang == 'ar')
            return $this->title_ar;
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

    protected function __getOffersUploadPath(){
        return '/uploads/offers/';
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage($request = null) {
        if($request != null){
            $image = $this->__getOffersUploadPath() . $this->image;
            $image_full_url = str_replace('/app_dev.php', '', $request->getUriForPath($image));    
            return $image_full_url;
        }
        return $this->image;
    }

    /**
     * populate an object to array
     */
    public function toArray($params) {

        if(!isset($params['lang']) || empty($params['lang'])){
            $params['lang'] = 'en';
        }

        $offerArray = array(
            'id' => $this->getId(),
            'title' => $this->getTitle($params['lang']),
            'description' => $this->getDescription($params['lang']),
            'valid_date' => $this->getValidDate(),
            'image' => $this->getImage($params['request'])
        );

        if(isset($params['has_venue'])) {
            $offerArray['vendor'] = $this->getVendor()->toArray($params);
        }
        return $offerArray;
    }


    /**
     * Set vendor
     *
     * @param \Dalilak\VenueBundle\Entity\Venue $vendor
     * @return Offer
     */
    public function setVendor(\Dalilak\VenueBundle\Entity\Venue $vendor = null) {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \Dalilak\VenueBundle\Entity\Venue 
     */
    public function getVendor() {
        return $this->vendor;
    }

    /**
     * Set title_ar
     *
     * @param string $titleAr
     * @return Offer
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

    /**
     * Set description
     *
     * @param string $description
     * @return Offer
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @param   string $lang
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
     * @return Offer
     */
    public function setDescriptionAr($descriptionAr) {
        $this->description_ar = $descriptionAr;

        return $this;
    }

    /**
     * Get description_ar
     *
     * @return string 
     */
    public function getDescriptionAr() {
        return $this->description_ar;
    }

        protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/offers';
    }

    public function upload() {
        $file = $this->getImageFile();
        
        // the file property can be empty if the field is not required
        if (null === $file) {
            return;
        }
        
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        
        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the
        // target filename to move to
        $file->move(
            $this->getUploadRootDir(), $fileName
            );
        $this->image = $fileName;
        $this->imageFile = null;
        $file = null;
        $fileName = null;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImageFile(UploadedFile $file = null) {
        $this->imageFile = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getImageFile() {
        return $this->imageFile;
    }
}
