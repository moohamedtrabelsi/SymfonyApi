<?php

namespace ClassesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClassesBundle:Default:index.html.twig');
    }
}
