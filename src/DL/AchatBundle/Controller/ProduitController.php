<?php

namespace DL\AchatBundle\Controller;

use DL\AchatBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function listProductsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('DLAchatBundle:Produit')->findAll();
        return $this->render('@DLAchat/Achat/allproducts.html.twig',array('products'=>$products));
    }

    public function detailProductAction(Produit $produit)
    {
        $form = $this->createDeleteForm($produit);

        return $this->render('@DLAchat/Achat/detailProduct.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }



    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detailProduct', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}
