<?php

namespace DL\AchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function allProductsAction()
    {
        return $this->render('@DLAchat/Achat/allproducts.html.twig');
    }

    public function detailProductAction()
    {
        return $this->render('@DLAchat/Achat/detailProduct.html.twig');
    }

    public function factureAction()
    {
        return $this->render('@DLAchat/Commande/Facture.html.twig');
    }
}
