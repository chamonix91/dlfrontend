<?php

namespace DL\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MesPartenairesController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficherpartenairesGAction(Request $request)
    {
        $utilisateur = $this->getUser();
        $id = $utilisateur->getId();
        $lchield = array();
        $rchield = array();
        $mlms = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:Mlm')
            ->findAll();
        $perso = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:Mlm')
            ->findOneByidpartenaire($id);
        $test = false;
        if (!empty($this->getleftpartner($perso->getcodegauche())) &&
            $this->getrightpartner($perso->getcodedroite())) {
            
            if ($perso->getcodegauche() != 'NULL' && $perso->getcodedroite() != 'NULL'
               ) {
                $test = true;
                array_push($lchield, $this->getleftpartner($perso->getcodegauche()));
                array_push($rchield, $this->getrightpartner($perso->getcodedroite()));
            }
        }
        /*****gauche*****/
        if($test ) {
            for ($i = 0; $i < count($rchield); $i++) {
                if (!empty($rchield[$i])) {
                    if ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                        if (!empty($this->getleftpartner($rchield[$i]->getcodegauche())) &&
                            !empty($this->getrightpartner($rchield[$i]->getcodedroite()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if ($this->getleftpartner($rchield[$i]->getcodegauche()) == $rchield[$ing] ||
                                    $this->getrightpartner($rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getleftpartner($rchield[$i]->getcodegauche()));
                            array_push($rchield, $this->getrightpartner($rchield[$i]->getcodedroite()));
                        }

                    } elseif ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() == 'NULL')) {
                        if (!empty($this->getleftpartner($rchield[$i]->getcodegauche()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if ($this->getleftpartner($rchield[$i]->getcodegauche()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getleftpartner($rchield[$i]->getcodegauche()));
                        }
                    } elseif ($rchield[$i]->getcodegauche() == 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                        if (!empty($this->getrightpartner($rchield[$i]->getcodedroite()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if (
                                    $this->getrightpartner($rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getrightpartner($rchield[$i]->getcodedroite()));
                        }
                    }
                }
            }//fin boucle rchield*/
            /****droite****/
            for ($i = 0; $i < count($lchield); $i++) {
                if (!empty($lchield[$i])) {
                    if ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() != 'NULL'
                    ) {
                        if (!empty($this->getleftpartner($lchield[$i]->getcodegauche())) &&
                            !empty($this->getrightpartner($lchield[$i]->getcodedroite()))) {
                            if ($this->getleftpartner($lchield[$i]->getcodegauche())->getIdpartenaire() == $perso->getIdpartenaire() ||
                                $this->getrightpartner($lchield[$i]->getcodedroite())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($lchield[$i]->getcodegauche()) == $lchield[$ing] ||
                                    $this->getrightpartner($lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($lchield[$i]->getcodegauche()));
                            array_push($lchield, $this->getrightpartner($lchield[$i]->getcodedroite()));
                            /* if($this->getleftpartner($lchield[$i]->getcodegauche())->getDateaffectation() > $startMonth){
                                 arr
                             }*/
                        }
                    } elseif ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() == 'NULL') {
                        if (!empty($this->getleftpartner($lchield[$i]->getcodegauche()))) {
                            if ($this->getleftpartner($lchield[$i]->getcodegauche())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($lchield[$i]->getcodegauche()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($lchield[$i]->getcodegauche()));
                            //array_push($nar, 1);
                        }
                    } elseif ($lchield[$i]->getcodegauche() == 'NULL' && $lchield[$i]->getcodedroite() != 'NULL') {
                        if (
                        !empty($this->getrightpartner($lchield[$i]->getcodedroite()))) {
                            if ($this->getrightpartner($lchield[$i]->getcodedroite())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if (
                                    $this->getrightpartner($lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getrightpartner($lchield[$i]->getcodedroite()));
                        }
                    }
                }
            }
        }//fin boucle lchield
        $flchield = array();
        $frchield = array();
        for($c=0;$c<count($lchield);$c++){
            if(empty($lchield[$c]->getCodegauche() )|| empty($lchield[$c]->getCodedroite())){
                $perso = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('DLUserBundle:User')
                    ->find($lchield[$c]->getIdpartenaire());
                array_push($flchield,$perso);
            }
        }
        for($c=0;$c<count($rchield);$c++){
            if(empty($rchield[$c]->getCodegauche()) || empty($rchield[$c]->getCodedroite())){
                //dump('hear');die();
                $perso = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('DLUserBundle:User')
                    ->find($rchield[$c]->getIdpartenaire());
                array_push($frchield,$perso);
            }
        }


        return $this->render('@DLBackoffice/BackLayout/MesPartenaires.html.twig', array('frchield' => $frchield, 'flchield' => $flchield));
    }




    public function afficherpartenairesDAction(Request $request)
    {
        $utilisateur = $this->getUser();
        $id = $utilisateur->getId();
        $lchield = array();
        $rchield = array();
        $mlms = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:Mlm')
            ->findAll();
        $perso = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:Mlm')
            ->findOneByidpartenaire($id);
        $test = false;
        if (!empty($this->getleftpartner($perso->getcodegauche())) &&
            $this->getrightpartner($perso->getcodedroite())) {

            if ($perso->getcodegauche() != 'NULL' && $perso->getcodedroite() != 'NULL'
            ) {
                $test = true;
                array_push($lchield, $this->getleftpartner($perso->getcodegauche()));
                array_push($rchield, $this->getrightpartner($perso->getcodedroite()));
            }
        }
        /*****gauche*****/
        if($test ) {
            for ($i = 0; $i < count($rchield); $i++) {
                if (!empty($rchield[$i])) {
                    if ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                        if (!empty($this->getleftpartner($rchield[$i]->getcodegauche())) &&
                            !empty($this->getrightpartner($rchield[$i]->getcodedroite()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if ($this->getleftpartner($rchield[$i]->getcodegauche()) == $rchield[$ing] ||
                                    $this->getrightpartner($rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getleftpartner($rchield[$i]->getcodegauche()));
                            array_push($rchield, $this->getrightpartner($rchield[$i]->getcodedroite()));
                        }

                    } elseif ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() == 'NULL')) {
                        if (!empty($this->getleftpartner($rchield[$i]->getcodegauche()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if ($this->getleftpartner($rchield[$i]->getcodegauche()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getleftpartner($rchield[$i]->getcodegauche()));
                        }
                    } elseif ($rchield[$i]->getcodegauche() == 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                        if (!empty($this->getrightpartner($rchield[$i]->getcodedroite()))) {
                            $t = 0;
                            for ($ing = 0; $ing < count($rchield); $ing++) {
                                if (
                                    $this->getrightpartner($rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($rchield, $this->getrightpartner($rchield[$i]->getcodedroite()));
                        }
                    }
                }
            }//fin boucle rchield*/
            /****droite****/
            for ($i = 0; $i < count($lchield); $i++) {
                if (!empty($lchield[$i])) {
                    if ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() != 'NULL'
                    ) {
                        if (!empty($this->getleftpartner($lchield[$i]->getcodegauche())) &&
                            !empty($this->getrightpartner($lchield[$i]->getcodedroite()))) {
                            if ($this->getleftpartner($lchield[$i]->getcodegauche())->getIdpartenaire() == $perso->getIdpartenaire() ||
                                $this->getrightpartner($lchield[$i]->getcodedroite())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($lchield[$i]->getcodegauche()) == $lchield[$ing] ||
                                    $this->getrightpartner($lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($lchield[$i]->getcodegauche()));
                            array_push($lchield, $this->getrightpartner($lchield[$i]->getcodedroite()));
                            /* if($this->getleftpartner($lchield[$i]->getcodegauche())->getDateaffectation() > $startMonth){
                                 arr
                             }*/
                        }
                    } elseif ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() == 'NULL') {
                        if (!empty($this->getleftpartner($lchield[$i]->getcodegauche()))) {
                            if ($this->getleftpartner($lchield[$i]->getcodegauche())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($lchield[$i]->getcodegauche()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($lchield[$i]->getcodegauche()));
                            //array_push($nar, 1);
                        }
                    } elseif ($lchield[$i]->getcodegauche() == 'NULL' && $lchield[$i]->getcodedroite() != 'NULL') {
                        if (
                        !empty($this->getrightpartner($lchield[$i]->getcodedroite()))) {
                            if ($this->getrightpartner($lchield[$i]->getcodedroite())->getIdpartenaire() == $perso->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if (
                                    $this->getrightpartner($lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getrightpartner($lchield[$i]->getcodedroite()));
                        }
                    }
                }
            }
        }//fin boucle lchield
        $flchield = array();
        $frchield = array();
        for($c=0;$c<count($lchield);$c++){
            if(empty($lchield[$c]->getCodegauche() )|| empty($lchield[$c]->getCodedroite())){
                $perso = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('DLUserBundle:User')
                    ->find($lchield[$c]->getIdpartenaire());
                array_push($flchield,$perso);
            }
        }
        for($c=0;$c<count($rchield);$c++){
            if(empty($rchield[$c]->getCodegauche()) || empty($rchield[$c]->getCodedroite())){
                //dump('hear');die();
                $perso = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('DLUserBundle:User')
                    ->find($rchield[$c]->getIdpartenaire());
                array_push($frchield,$perso);
            }
        }


        return $this->render('@DLBackoffice/BackLayout/MesPartenairesD.html.twig', array('frchield' => $frchield, 'flchield' => $flchield));
    }






    public function getleftpartner($code)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->findOneBycode($code);
        if ($user) {
            $mlm = $this->get('doctrine.orm.entity_manager')
                ->getRepository('DLUserBundle:Mlm')
                ->findOneByidpartenaire($user->getId());
            if ($mlm != Null)
                return $mlm;
            else
                return Null;
        } else {
            return Null;
        }
    }

    public function getrightpartner($code)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->findOneBycode($code);
        if ($user) {
            $mlm = $this->get('doctrine.orm.entity_manager')
                ->getRepository('DLUserBundle:Mlm')
                ->findOneByidpartenaire($user->getId());
            if ($mlm != Null)
                return $mlm;
            else
                return Null;
        } else {
            return Null;
        }
    }

    public function getmyinfo($id)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLUserBundle:User')
            ->find($id);
        return $user;
    }

}

