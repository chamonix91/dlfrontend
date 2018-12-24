<?php

namespace DL\AchatBundle\Controller;


use DL\AchatBundle\Entity\Panier;
use DL\AchatBundle\Entity\Produit;
use DL\AchatBundle\Form\CommandeType;
use DL\AchatBundle\Entity\Commande;
use DL\AchatBundle \Entity\Achat;
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

    public function commandeaddedAction()
    {
        return $this->render('@DLAchat/Commande/CommandeAdded.html.twig');
    }

    function addcommandeAction(Request $request,$id)
    {


        $panier =new Panier();
        $em=$this->getDoctrine()->getManager();

        $user = $this->getUser();
        $iduser= $user->getId();


        $produit=$em->getRepository('DLAchatBundle:Produit')->find($id);
        $utilisateur=$em->getRepository('DLUserBundle:User')->find($iduser);

        if ($panier)
        {
            $panier->setIdproduit($produit->getId());
            $panier->setIdpartenaire($iduser);
            $panier->setEtat(false);
            $em->persist($panier);
            $em->flush();


            return $this->redirectToRoute('mescommandes');
        }
            return  $this->render('',array(
                'panier'=>$panier,
                'produit'=>$produit,
                'user'=>$utilisateur,

            ));

    }


    public function factureNetworkerAction(User $user)
    {

        $form = $this->createDeleteForm($user);
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        // ---------- Panier de l'utilisateur --------------
        $panier=$em->getRepository('DLAchatBundle:Panier')->findby(array('idpartenaire'=>$id));

        // ---------- commande de l'utilisateur --------------
        $commandes = $em->getRepository('DLAchatBundle:Commande')->findBy(array('idpartenaire'=>$id));

        $prixtotal = 0 ;
        $produits = array();

        // ----------- transformer l'état dans la table panier + calcul de la somme  ------------//
        foreach ($panier as $p) {
            if ($p->getEtat() == false){
                $panier=$em->getRepository('DLAchatBundle:Panier')->findOneby(array('idpartenaire'=>$id));
                $idproduit = $p->getidproduit();
                $produit = $em->getRepository('DLAchatBundle:Produit')->find(array('id' =>$idproduit));
                array_push($produits, $produit ); //récupérer les produits du panier
                $prix = $produit->getPrix();
                $prixtotal = $prixtotal + $prix;
                $etat = true;
                //$p->setEtat($etat);
                //$em->persist($p);
                $em->flush();
            }
        }

        $prixfinal = 0;
        if (count($commandes) >= 1){
            foreach ($commandes as $c){
                $prixfinal = $prixfinal + $c->getMontant();
                $commande = $em->getRepository('DLAchatBundle:Commande')->find(array('id'=>$c->getId()));
                $em->remove($commande);
                $em->flush();
            }
        }
        else{
            $commande = new Commande();
        }


        $prixfinal = $prixfinal + $prixtotal;
        $commande->setMontant($prixfinal);
        $commande->setIdpartenaire($id);
        $commande->setEtat(false);
        $em->persist($commande);
        $em->flush();

        if ($commande){
            return $this->redirectToRoute('facture_finale', array('id' => $user->getId()));
        }

        return $this->render('DLAchatBundle:Commande:Facture.html.twig', array(
            'produits'=>$produits,
            'panier' => $panier,
            'commande' => $commande,
            'form' => $form->createView(),
        ));
    }

    public function facturefinaleAction(User $user){

        $form = $this->createDeleteForm($user);
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        // ---------- Panier de l'utilisateur --------------
        $panier=$em->getRepository('DLAchatBundle:Panier')->findby(array('idpartenaire'=>$id));
        $prixtotal=0;
        $produits = array();


        // ----------- transformer l'état dans la table panier + calcul de la somme  ------------//
        foreach ($panier as $p) {
            //dump($panier);die();
            if ($p->getEtat() == false){
                $panier=$em->getRepository('DLAchatBundle:Panier')->findOneby(array('idpartenaire'=>$id));
                $idproduit = $p->getidproduit();
                $produit = $em->getRepository('DLAchatBundle:Produit')->find(array('id' =>$idproduit));
                array_push($produits, $produit ); //récupérer les produits du panier
                $prix = $produit->getPrix();
                $prixtotal = $prixtotal + $prix;
                $etat = true;
                $p->setEtat($etat);
                $em->persist($p);
                $em->flush();
            }
        }

        return $this->render('DLAchatBundle:Commande:FactureFinale.html.twig',array(
            'produits'=>$produits,
            'prixtotal'=>$prixtotal,
            'panier' => $panier,
            'form' => $form->createView()
        ));

    }





    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facturationNetworker', array('id' => $user->getId())))
            ->getForm()
            ;
    }

    public function deleteAction(Request $request, Panier $panier)
    {
        $form = $this->createDeleteFormPanier($panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panier);
            $em->flush();
        }

        return $this->redirectToRoute('mescommandes');
    }

    private function createDeleteFormPanier(Panier $panier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('panier_delete', array('id' => $panier->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



    public function deletePanierAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $panier=$em->getRepository('DLAchatBundle:Panier')->find(array('id'=>$id));

        if ($panier){
        $em->remove($panier);

        $em->flush();

        }
        return $this->redirectToRoute('mescommandes');
    }




}


