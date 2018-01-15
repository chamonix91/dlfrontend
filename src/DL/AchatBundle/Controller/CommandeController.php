<?php

namespace DL\AchatBundle\Controller;


use DL\AchatBundle\Form\CommandeType;
use DL\AchatBundle \Entity\Commande;
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


        $form=$this->createForm(CommandeType::class,$commande);
        if($form->handleRequest($request)->isValid())
        {

            $commande->setIdproduit($produit);
            $commande->setIdpartenaire($user);
            $em->persist($commande);
            $em->flush();
            return  $this->render('@DLAchat/Commande/Facture.html.twig',array('commande'=>$commande));
        }
        return $this->render('@DLAchat/Commande/CommandeNetworker.html.twig',array('f'=>$form->createView()));
    }
}
