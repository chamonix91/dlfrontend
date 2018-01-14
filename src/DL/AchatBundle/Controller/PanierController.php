<?php

namespace DL\AchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function ajouterAction(Request $request)
    {
        $session = $request->getSession();
        $user= $this->getUser();
        $id= $user->getId();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('panier'));    }

    public function supprimerAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function panierAction(Request $request)
    {

        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('DLAchatBundle:Produit')->findArray(array_keys($session->get('panier')));

        return $this->render('@DLAchat/Panier/panier.html.twig', array('produits' => $produits,
            'panier' => $session->get('panier')));
    }


}
