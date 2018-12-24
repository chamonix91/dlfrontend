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
        $em = $this->getDoctrine()->getManager();

        $produit = $em->getRepository('DLAchatBundle:Produit')->findByStock();

        return $this->render('DLFrontendBundle:Front:inedx.html.twig', array('produits'=>$produit));
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
        $challenge =$em->getRepository('DLFrontendBundle:Challenge')->findby(array(),array('id'=>'desc'));




        for($c=0;$c<count($challenge);$c++){
            array_push($imgs,stream_get_contents($challenge[$c]->getLogo()));
        }
        return $this->render('DLFrontendBundle:Front:inedx.html.twig',array('challenges'=>$challenge,'imgs'=>$imgs));
    }

























}
