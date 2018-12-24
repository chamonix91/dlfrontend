<?php

namespace DL\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function detailproduitAction()
    {
        return $this->render('DLFrontendBundle:Front:detailproduit.html.twig');
    }

    public function allproductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('DLAchatBundle:Produit')->findByStock();

        $paginator=$this->get('knp_paginator');
        $result =$paginator->paginate(
            $produits,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',9)

        );
        return $this->render('DLFrontendBundle:Front:allproducts.html.twig', array('produits'=>$produits,'pagination' => $result));
    }
}
