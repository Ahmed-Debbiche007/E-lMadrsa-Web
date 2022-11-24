<?php


namespace App\Entity;




use Attribute;
use Symfony\Component\Validator\Constraint;


#[Attribute]
class profanityconstraint extends Constraint
{
    public string $message = 'Your input contains an illegal word.';
    // If the constraint has configuration options, define them as public properties
    //public string $mode = 'strict';
    /**
     * @return string
     */

    public function validatedBY()
    {

        return static::class.'validator';


    }

}