<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 16/10/2014
 * Time: 10:25
 */

namespace Blog\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageController extends Controller
{

    public function manageAction()
    {
        return $this->render('@BlogBlog/Manage/manage.html.twig');
    }

} 