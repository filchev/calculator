<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DriverLicensePhotoRepository")
 */
class DriverLicensePhoto extends FileUpload
{
    
}
