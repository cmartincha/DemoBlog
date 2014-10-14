<?php

namespace Blog\BlogBundle\Controller;


use Blog\BlogBundle\Entity\Registration;
use Blog\BlogBundle\Entity\Rol;
use Blog\BlogBundle\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class LoginController extends Controller {
    public function loginAction(Request $request) {
        $registration = new Registration();
        $form_register = $this->createForm(new RegisterType(), $registration);

        $form_register->handleRequest($request);

        if ($form_register->isValid()) {
            $user = $registration->getUser();

            $encoder = $this->get('security.encoder_factory')
                ->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword() , $user->getSalt());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();

            $rol = $entityManager->getRepository('BlogBlogBundle:Rol')->find(Rol::ROLE_USER_ID);
            $user->setRol($rol);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('blog_blog_homepage'));
        }

        $session = $request->getSession();
        $login_error = '';

        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $login_error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif ($session !== null && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $login_error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }

        $last_username = $session === null ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render('BlogBlogBundle:Login:login.html.twig',
            array(
                'form_register' => $form_register->createView(),
                'login_error'   => $login_error,
                'last_username' => $last_username,
            )
        );
    }

}