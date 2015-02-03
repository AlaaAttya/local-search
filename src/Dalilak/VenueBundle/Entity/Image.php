<?php

namespace Dalilak\VenueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Image
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Entity
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="Dalilak\VenueBundle\Repository\ImageRepository")
 */
class Image {
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
     * @Assert\File(maxSize="6000000")
     */
    private $imageFile;

    /**
     * Image venue 
     *
     * @ORM\ManyToOne(targetEntity="Dalilak\VenueBundle\Entity\Album",inversedBy="images")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $album;

    /**
     * Image or logo
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=255, nullable=true)
     */
    private $imageType;

    /**
     * Image caption
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * Image name
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     */
    private $image_name;

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
     * @return Image
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
     * Set album
     *
     * @param string $album
     * @return Image
     */
    public function setAlbum($album) {
        $this->album = $album;

        return $this;
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

    /**
     * Get venue
     *
     * @return string 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/venues';
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
        $this->title = $fileName;
        $this->imageFile = null;
        $file = null;
        $fileName = null;
    }

    /**
     * Set imageType
     *
     * @param string $imageType
     * @return Image
     */
    public function setImageType($imageType) {
        $this->imageType = $imageType;

        return $this;
    }

    /**
     * Get imageType
     *
     * @return string 
     */
    public function getImageType() {
        return $this->imageType;
    }

    /**
     * Set caption
     *
     * @param string $caption
     * @return Image
     */
    public function setCaption($caption) {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string 
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * Set image_name
     *
     * @param string $imageName
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->image_name = $imageName;

        return $this;
    }

    /**
     * Get image_name
     *
     * @return string 
     */
    public function getImageName($request) {
        $image = $this->__getImageUploadPath() . $this->image_name;
        $image_full_url = str_replace('/app_dev.php', '', $request->getUriForPath($image));
        return $image_full_url;
    }

    protected function __getImageUploadPath(){
        return '/uploads/venues/albums/';
    }

    public function toArray($params){
        return array(
            'id' => $this->id,
            'caption' => $this->getCaption(),
            'image_url' => $this->getImageName($params['request'])
        );
    }
}
