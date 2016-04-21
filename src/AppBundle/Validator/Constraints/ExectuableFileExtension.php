<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ExectuableFileExtension extends Constraint
{

    public $message = 'The %string% file extension is not allowed.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }   

}
