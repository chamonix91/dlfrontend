<?php

namespace DL\AchatBundle\Controller;

use DL\AchatBundle\Entity\Panier;
use DL\AchatBundle\Entity\Produit;
use DL\AchatBundle \Entity\Achat;
use DL\UserBundle\Entity\User;
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
            'user'=>$utilisateur
        ));

    }





    public function factureClientAction(User $user)
    {

        $form = $this->createDeleteForm($user);
        $em = $this->getDoctrine()->getManager();
        $achat = new Achat();

        $id = $this->getUser()->getId();
        $panier=$em->getRepository('DLAchatBundle:Panier')->findby(array('idpartenaire'=>$id));
        $allproducts = $em->getRepository('DLAchatBundle:Panier')->findby(array('etat'=>false));
        $prixtotal = 0 ;

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

        $achat->setMontant($prixtotal);
        $achat->setIdpartenaire($id);
        $achat->setEtat(false);

        $em->persist($achat);
        $em->flush();




        return $this->render('DLAchatBundle:Commande:Facture.html.twig', array(
            'produits'=>$produits,
            'panier' => $panier,
            'achat' => $achat,
            'form' => $form->createView(),
        ));
    }






    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facturationClient', array('id' => $user->getId())))
            ->getForm()
            ;
    }
}
