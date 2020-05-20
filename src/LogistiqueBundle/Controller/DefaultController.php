<?php

namespace LogistiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LogistiqueBundle:Default:index.html.twig');
    }
}
