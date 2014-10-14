<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 09/10/2014
 * Time: 11:21
 */

namespace Blog\BlogBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('user', new UserType())
            ->add('repeatPassword', 'password', array('label' => 'repeat_password'))
            ->add('register', 'submit', array('label' => 'register'));

    }

    public function getName() {
        return 'blog_blogbundle_registration';
    }
} 