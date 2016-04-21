<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class CarDocumentsPhoto extends FileUpload
{
    
    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"},
     *     mimeTypesMessage = "Invalid file type. Allowed file types are png, jpg ,pjpeg",
     *     maxSizeMessage = "File is too big. Maximum file size is 10mb"
     * )
     * @Vich\UploadableField(mapping="car_documents", fileNameProperty="carDocumentsPhotoFile")
     * 
     * @var File
     */
    private $carDocumentsPhoto;
    
     /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $carDocumentsPhoto
     *
     * @return Image
     */
    public function setCarDocumentsPhoto(File $carDocumentsPhoto = null)
    {
        $this->carDocumentsPhoto = $carDocumentsPhoto;

        if ($carDocumentsPhoto) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getCarDocumentsPhoto()
    {
        return $this->carDocumentsPhoto;
    }

    /**
     * @param string $carDocumentsPhotoName
     *
     * @return Product
     */
    public function setCarDocumentsPhotoFile($carDocumentsPhotoName)
    {
        $this->carDocumentsPhotoName = $carDocumentsPhotoName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCarDocumentsPhotoFile()
    {
        return $this->carDocumentsPhotoName;
    }

  
}
