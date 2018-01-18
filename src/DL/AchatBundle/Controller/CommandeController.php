<?php

namespace DL\AchatBundle\Controller;


use DL\AchatBundle\Entity\Produit;
use DL\AchatBundle\Form\CommandeType;
use DL\AchatBundle\Entity\Commande;
use DL\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function addcommandeAction(Request $request,$id)
    {

        $commande =new Commande();
        $em=$this->getDoctrine()->getManager();

        $user = $this->getUser();
        $iduser= $user->getId();


        $produit=$em->getRepository('DLAchatBundle:Produit')->find($id);
        $utilisateur=$em->getRepository('DLUserBundle:User')->find($iduser);




            $commande->setIdproduit($produit->getId());
            $commande->setIdpartenaire($iduser);
            $em->persist($commande);
            $em->flush();
            return  $this->render('@DLAchat/Commande/Facture.html.twig',array(
                'commande'=>$commande,
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
