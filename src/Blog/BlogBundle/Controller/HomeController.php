<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction($page)
    {
        return $this->render('BlogBlogBundle:Home:index.html.twig', compact('page'));
    }
}
