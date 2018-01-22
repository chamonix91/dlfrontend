<?php

namespace DL\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function detailproduitAction()
    {
        return $this->render('DLFrontendBundle:Front:detailproduit.html.twig');
    }
}
