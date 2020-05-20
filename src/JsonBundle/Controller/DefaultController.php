<?php

namespace JsonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JsonBundle:Default:index.html.twig');
    }
}
