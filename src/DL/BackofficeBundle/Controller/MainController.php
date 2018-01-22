<?php

namespace DL\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:index.html.twig');
    }

    public function showtreeAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:tree.html.twig');
    }

    public function challengeAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:challenge.html.twig');
    }

    public function eventAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:event.html.twig');
    }

    public function erreuradduserAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:erreuradduser.html.twig');
    }

    public function erreurarbreAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:erreurarbre.html.twig');
    }


}
