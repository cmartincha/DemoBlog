<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 10/10/2014
 * Time: 18:23
 */

namespace Blog\BlogBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SamePassword extends Constraint {
    public $message = 'Passwords must be the same';

    public function validatedBy() {
        return get_class($this) . 'Validator';
    }

    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
} 