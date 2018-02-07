<?php

namespace DL\BackofficeBundle\Controller;

use DL\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('DLBackofficeBundle:BackLayout:index.html.twig');
    }

    public function showtreeAction(Request $request, $id)
    {

        $user = $this->getUser();
        $id = $user->getId();

        return $this->render('DLBackofficeBundle:BackLayout:tree.html.twig', array('id'=>$id));
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
