<?php

namespace DL\AchatBundle\Controller;

use DL\AchatBundle\Entity\Produit;
use DL\AchatBundle \Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AchatController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function addachatAction(Request $request,$id)
    {

        $achat =new Achat();
        $em=$this->getDoctrine()->getManager();

        $user = $this->getUser();
        $iduser= $user->getId();


        $produit=$em->getRepository('DLAchatBundle:Produit')->find($id);
        $utilisateur=$em->getRepository('DLUserBundle:User')->find($iduser);




        $achat->setIdproduit($produit->getId());
        $achat->setIdpartenaire($iduser);
        $em->persist($achat);
        $em->flush();
        return  $this->render('@DLAchat/Commande/Facture.html.twig',array(
            'achat'=>$achat,
            'produit'=>$produit,
            'user'=>$utilisateur
        ));

    }

    public function factureAction(Produit $produit)
    {
        $form = $this->createDeleteForm($produit);

        return $this->render('DLAchatBundle:Commande:Facture.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }



    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facturation', array('id' => $produit->getId())))
            ->getForm()
            ;
    }
}
