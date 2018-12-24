<?php

namespace DL\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MesPartenairesController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficherpartenairesGAction(Request $request, $id)
    {

        $left = "http://54.38.182.154/left/5300";

        $user = $this->getUser();
        $id = $user->getId();

        return $this->render('@DLBackoffice/BackLayout/MesPartenaires.html.twig', array('id'=>$id,
            'left'=> $left));
    }




    public function afficherpartenairesDAction(Request $request, $id)
    {

        $left = "http://54.38.182.154/right/5300";

        $user = $this->getUser();
        $id = $user->getId();

        return $this->render('@DLBackoffice/BackLayout/MesPartenairesD.html.twig', array('id'=>$id,
            'left'=> $left));

    }






    public function getleftpartner($code)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->findOneBy(array('code'=>$code));
        if ($user) {
            $mlm = $this->get('doctrine.orm.entity_manager')
                ->getRepository('DLUserBundle:Mlm')
                ->findOneByidpartenaire($user->getId());
            if ($mlm != Null)
                return $mlm;
            else
                return Null;
        } else {
            return Null;
        }
    }

    public function getrightpartner($code)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->findOneBycode($code);
        if ($user) {
            $mlm = $this->get('doctrine.orm.entity_manager')
                ->getRepository('DLUserBundle:Mlm')
                ->findOneByidpartenaire($user->getId());
            if ($mlm != Null)
                return $mlm;
            else
                return Null;
        } else {
            return Null;
        }
    }

    public function getmyinfo($id)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->find($id);
        return $user;
    }

}

