<?php

namespace DL\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DLFrontendBundle:Default:index.html.twig');
    }
}
