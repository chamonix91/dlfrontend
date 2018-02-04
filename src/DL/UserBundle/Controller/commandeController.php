<?php

namespace DL\UserBundle\Controller;

use DL\AchatBundle\Entity\Commande;
use DL\AchatBundle\Entity\Panier;
use DL\AchatBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class commandeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function mescommandesAction()
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


        

        
        return $this->render('@DLUser/commandes/mescommandes.html.twig',
            array('panier' => $panier, 'produit' => $allproducts));
    }
}
