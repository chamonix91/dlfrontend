<?php

namespace DL\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function addUserAction()
    {
        return $this->render('@DLUser/Backoffice/register.html.twig');
    }
}
