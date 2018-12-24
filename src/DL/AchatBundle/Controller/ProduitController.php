<?php

namespace DL\AchatBundle\Controller;

use DL\AchatBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

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

        $em = $this->getDoctrine()->getManager();

        $idimg1 = $produit->getId();
        $image1= $em->getRepository('DLAchatBundle:Produit')->findOneBy(array('image1'=>$idimg1));

        $idimg2 = $produit->getId();
        $image2= $em->getRepository('DLAchatBundle:Produit')->findOneBy(array('image1'=>$idimg2));

        $idimg3 = $produit->getId();
        $image3= $em->getRepository('DLAchatBundle:Produit')->findOneBy(array('image1'=>$idimg3));


        return $this->render('@DLAchat/Achat/detailProduct.html.twig', array(
            'image1'=>$image1,
            'img2'=>$image2,
            'image3'=>$image3,
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
