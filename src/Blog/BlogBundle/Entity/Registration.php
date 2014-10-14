<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 09/10/2014
 * Time: 11:38
 */

namespace Blog\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Blog\BlogBundle\Validator\Constraints as BlogAssert;

/**
 * Class Registration
 * @package Blog\BlogBundle\Entity
 * @BlogAssert\SamePassword
 */
class Registration {

    /**
     * @Assert\Type(type="Blog\BlogBundle\Entity\User")
     * @Assert\Valid()
     */
    private $user;

    /**
     * @Assert\NotBlank()
     */
    private $repeatPassword;


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getRepeatPassword()
    {
        return $this->repeatPassword;
    }

    /**
     * @param mixed $repeat_password
     */
    public function setRepeatPassword($repeat_password)
    {
        $this->repeatPassword = $repeat_password;
    }
}