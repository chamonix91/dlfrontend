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
        $commande = new Commande();

        $id = $this->getUser()->getId();
        $panier=$em->getRepository('DLAchatBundle:Panier')->findby(array('idpartenaire'=>$id));
        $prixtotal = 0 ;
        $produits = array();

        foreach ($panier as $p) {

            if ($p->getEtat() == false){


           // dump($p->getidproduit());die;
            $panier=$em->getRepository('DLAchatBundle:Panier')->findOneby(array('idpartenaire'=>$id));

                $idproduit = $p->getidproduit();

            $produit = $em->getRepository('DLAchatBundle:Produit')->find(array('id' =>$idproduit));


                array_push($produits, $produit );

            $prixtotal = $prixtotal + $produit->getPrix();

            $etat = true;
            $p->setEtat($etat);

            $em->persist($p);
            $em->flush();

            }
        }

        $commande->setMontant($prixtotal);
        $commande->setIdpartenaire($id);
        $commande->setEtat(false);

        $em->persist($commande);
        $em->flush();



        return $this->render('DLAchatBundle:Commande:Facture.html.twig', array(
            'produits'=>$produits,
            'panier' => $panier,
            'commande' => $commande,
            'form' => $form->createView(),
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


