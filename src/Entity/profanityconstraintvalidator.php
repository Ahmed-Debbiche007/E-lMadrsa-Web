<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class profanityconstraintvalidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {

        // TODO: Implement validate() method.
        $check = new check();
        if ($check->hasProfanity($value) === true) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{string}}', $value)
                ->addViolation();


        };

    }
}