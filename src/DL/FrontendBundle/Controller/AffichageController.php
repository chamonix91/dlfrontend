<?php

namespace DL\FrontendBundle\Controller;

use DL\AchatBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AffichageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function accueilAction()
    {
        return $this->render('@DLFrontend/Front/inedx.html.twig');
    }

    public function actualiteAction()
    {
        return $this->render('@DLFrontend/Front/actualite.html.twig');
    }

    public function listProductsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('DLAchatBundle:Produit')->findAll();
        $imgs = array();
        
        
        for($c=0;$c<count($products);$c++){
            array_push($imgs,stream_get_contents($products[$c]->getImage1()));
        }
        return $this->render('DLFrontendBundle:Front:inedx.html.twig',array('products'=>$products,'imgs'=>$imgs));
    }

    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detailProduct', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function listchallengeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $challenge =$em->getRepository('DLFrontendBundle:Challenge')->findAll();




        for($c=0;$c<count($products);$c++){
            array_push($imgs,stream_get_contents($products[$c]->getImage1()));
        }
        return $this->render('DLFrontendBundle:Front:inedx.html.twig',array('products'=>$products,'imgs'=>$imgs));
    }

























}
