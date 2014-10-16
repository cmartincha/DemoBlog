<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 16/10/2014
 * Time: 10:37
 */

namespace Blog\BlogBundle\Controller;


use Blog\BlogBundle\Entity\Post;
use Blog\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function createAction(Request $request)
    {
        $post = new Post();
        $form_post_create = $this->createForm(new PostType(), $post);

        $form_post_create->handleRequest($request);

        if ($form_post_create->isValid()) {

        } else {

        }

        return $this->render('@BlogBlog/Post/post_create.html.twig', array('form_post_create' => $form_post_create->createView()));
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }

    public function listAction()
    {

    }
} 