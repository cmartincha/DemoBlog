<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 10/10/2014
 * Time: 18:04
 */

namespace Blog\BlogBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SamePasswordValidator extends ConstraintValidator{
    public function validate($registration, Constraint $constraint) {
        if ($registration->getRepeatPassword() != $registration->getUser()->getPassword()) {
            $this->context->addViolationAt(
                'repeatPassword',
                $constraint->message
            );
        }
    }
}