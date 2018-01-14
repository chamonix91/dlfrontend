<?php

namespace DL\AchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
