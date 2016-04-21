<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FileUploadRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 * 
 */
class FileUpload
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"},
     *     mimeTypesMessage = "Invalid file type. Allowed file types are png, jpg ,pjpeg",
     *     maxSizeMessage = "File is too big. Maximum file size is 10mb"
     * )
     * @Vich\UploadableField(mapping="policy_image", fileNameProperty="imageName", nullable=true)
     * 
     * @AppAssert\ExectuableFileExtension
     * 
     * @var File
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $imageName;

    /**
     *
     * @ORM\ManyToOne(targetEntity="InsurancePolicy", inversedBy="fileUploadImage",cascade={"persist"})
     * @ORM\JoinColumn(name="policy_id", referencedColumnName="id")
     */
    protected $policy;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"},
     *     mimeTypesMessage = "Invalid file type. Allowed file types are png, jpg ,pjpeg",
     *     maxSizeMessage = "File is too big. Maximum file size is 10mb"
     * )
     * @Vich\UploadableField(mapping="car_documents_image", fileNameProperty="carDocumentsImageName", nullable=true)
     * @AppAssert\ExectuableFileExtension
     * @var File
     * 
     */
    protected $carDocumentsImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $carDocumentsImageName;

    protected function validateFile(File $file)
    {
        
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return FileUpload
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set policy
     *
     * @param \AppBundle\Entity\InsurancePolicy $policy
     * @return FileUpload
     */
    public function setPolicy(\AppBundle\Entity\InsurancePolicy $policy = null)
    {
        $this->policy = $policy;

        return $this;
    }

    /**
     * Get policy
     *
     * @return \AppBundle\Entity\InsurancePolicy 
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $carDocumentsImage
     *
     * @return Image
     */
    public function setCarDocumentsImageFile(File $carDocumentsImage = null)
    {
        $this->carDocumentsImageFile = $carDocumentsImage;
//        exit;
        if ($carDocumentsImage) {

            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getCarDocumentsImageFile()
    {
        return $this->carDocumentsImageFile;
    }

    /**
     * @param string $carDocumentsImageName
     *
     * @return Product
     */
    public function setCarDocumentsImageName($carDocumentsImageName)
    {
        $this->carDocumentsImageName = $carDocumentsImageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCarDocumentsImageName()
    {
        return $this->carDocumentsImageName;
    }

}
