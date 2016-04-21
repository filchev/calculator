<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ExectuableFileExtensionValidator extends ConstraintValidator
{

    public function validate($file, Constraint $constraint)
    {
//        dump($file, $file->getClientOriginalExtension());
//        exit;
        if ($file != null) {
            $allowedExtensions = ['jpg', 'png', 'gif', 'jpeg'];

            $fileExtension = strtolower($file->getClientOriginalExtension());
            if (!in_array($fileExtension, $allowedExtensions)) {
                switch ($fileExtension) {
//                case "php":
//                    echo "BANNED";
//                    break;
                    default :
                        $this->context->buildViolation($constraint->message)
                                ->setParameter('%string%', $fileExtension)
                                ->addViolation();
                        break;
                }
            }
        }
    }

}
