<?php

namespace DL\BackofficeBundle\Controller;

use DL\AchatBundle\Entity\Panier;
use DL\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $p = new Panier();
        $user = $this->getUser();
        $idpartenaire= $user->getId();
        $panier=$em->getRepository('DLAchatBundle:Panier')->findBy(array('idpartenaire'=>$idpartenaire));



        $produit = array();
        foreach ($panier as $p){
            $idproduit = $p->getIdproduit();
            $produit[] = $em->getRepository('DLAchatBundle:Produit')->find($idproduit);

        }

        $allproducts = $em->getRepository('DLAchatBundle:Produit')->findAll();

        return $this->render('DLBackofficeBundle:BackLayout:index.html.twig',
            array('panier' => $panier, 'produit' => $allproducts));
    }

    public function showtreeAction(Request $request, $id)
    {
        $tree = "http://54.38.182.154/mytree/";

        $user = $this->getUser();
        $id = $user->getId();

        return $this->render('DLBackofficeBundle:BackLayout:tree.html.twig', array('id'=>$id,
            'adresse'=> $tree));
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
