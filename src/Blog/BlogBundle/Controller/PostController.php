<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 16/10/2014
 * Time: 10:37
 */

namespace Blog\BlogBundle\Controller;


use Blog\BlogBundle\Entity\Post;
use Blog\BlogBundle\Entity\PostRepository;
use Blog\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function saveAction($post_id, Request $request)
    {
        if ($post_id) {
            $post = $this->getDoctrine()
                ->getRepository('BlogBlogBundle:Post')
                ->find($post_id);
        } else {
            $post = new Post();
        }

        $form_post_create = $this->createForm(new PostType(), $post);

        $form_post_create->handleRequest($request);

        if ($form_post_create->isValid()) {
            $user = $user = $this->getUser();
            $post->setUser($user);

            $entity_manager = $this->getDoctrine()->getManager();
            $entity_manager->persist($post);
            $entity_manager->flush();

            return $this->redirect($this->generateUrl('blog_blog_manage'));
        }

        return $this->render('@BlogBlog/Post/post_create.html.twig', array('form_post_create' => $form_post_create->createView()));
    }

    public function deleteAction($post_id)
    {
        if ($post_id > 0) {
            $entity_manager = $this->getDoctrine()->getManager();
            $post = $entity_manager->getRepository('BlogBlogBundle:Post')
                ->find($post_id);

            $entity_manager->remove($post);
            $entity_manager->flush();

            return $this->redirect($this->generateUrl('blog_blog_manage'));
        }
    }

    public function listManageAction()
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $posts = $entity_manager->getRepository('BlogBlogBundle:User')
            ->findPostsOrderByDate($this->getUser()->getId());

        return $this->render("@BlogBlog/Post/post_list.html.twig", compact('posts'));
    }

    public function listHomeAction($page)
    {
        $entity_manager = $this->getDoctrine()
            ->getManager();

        $posts = $entity_manager->getRepository('BlogBlogBundle:Post')
            ->findPostsOrderByDate($page);

        return $this->render('@BlogBlog/Post/post_list_home.html.twig',
            array(
                'posts' => $posts,
                'page' => $page,
                'page_count' => ceil($posts->count() / PostRepository::RESULTS_PER_PAGE),
            ));
    }

    public function archiveAction()
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $dates = $entity_manager->getRepository('BlogBlogBundle:Post')
            ->findPostDates();

        return $this->render('BlogBlogBundle:Post:post_archive.html.twig', compact('dates'));
    }
} 