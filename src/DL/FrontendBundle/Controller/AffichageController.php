<?php

namespace DL\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AffichageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function accueilAction()
    {
        return $this->render('@DLFrontend/Front/inedx.html.twig');
    }
}
