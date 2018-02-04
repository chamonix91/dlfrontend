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

    public function afficherpartenairesAction(Request $request)
    {

        /*****gauche*****/
        $activer = $this->get('doctrine.orm.entity_manager')->getRepository('DLBackofficeBundle:Mlm')->findBy(array('affectation' => 1));
        $id = $request->get('id');
        $mlms = $this->get('doctrine.orm.entity_manager')->getRepository('DLBackofficeBundle:Mlm')->findOneByidpartenaire($id);
        $test = false;
        if ($mlms->getcodegauche() != 'NULL' && !empty($this->getleftpartner($activer, $mlms->getcodegauche()))) {
            array_push($lchield, $this->getleftpartner($activer, $mlms->getcodegauche()));
        }
        if ($test) {
            for ($i = 0; $i < count($lchield); $i++) {

                if (!empty($lchield[$i])) {


                    if ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() != 'NULL'
                    ) {
                        if (!empty($this->getleftpartner($activer, $lchield[$i]->getcodegauche())) &&
                            !empty($this->getrightpartner($activer, $lchield[$i]->getcodedroite()))) {
                            if ($this->getleftpartner($activer, $lchield[$i]->getcodegauche())->getIdpartenaire() == $mlms->getIdpartenaire() ||
                                $this->getrightpartner($activer, $lchield[$i]->getcodedroite())->getIdpartenaire() == $mlms->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($activer, $lchield[$i]->getcodegauche()) == $lchield[$ing] ||
                                    $this->getrightpartner($activer, $lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($activer, $lchield[$i]->getcodegauche()));
                            array_push($lchield, $this->getrightpartner($activer, $lchield[$i]->getcodedroite()));
                            /* if($this->getleftpartner($lchield[$i]->getcodegauche())->getDateaffectation() > $startMonth){
                                 arr
                             }*/
                        }
                    } elseif ($lchield[$i]->getcodegauche() != 'NULL' && $lchield[$i]->getcodedroite() == 'NULL') {
                        if (!empty($this->getleftpartner($activer, $lchield[$i]->getcodegauche()))) {
                            if ($this->getleftpartner($activer, $lchield[$i]->getcodegauche())->getIdpartenaire() == $mlms->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if ($this->getleftpartner($activer, $lchield[$i]->getcodegauche()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getleftpartner($activer, $lchield[$i]->getcodegauche()));
                            //array_push($nar, 1);
                        }
                    } elseif ($lchield[$i]->getcodegauche() == 'NULL' && $lchield[$i]->getcodedroite() != 'NULL') {
                        if (
                        !empty($this->getrightpartner($activer, $lchield[$i]->getcodedroite()))) {
                            if ($this->getrightpartner($activer, $lchield[$i]->getcodedroite())->getIdpartenaire() == $mlms->getIdpartenaire()) {
                                //var_dump($lchield[$i]);die();
                                break;
                            }
                            $t = 0;
                            for ($ing = 0; $ing < count($lchield); $ing++) {
                                if (
                                    $this->getrightpartner($activer, $lchield[$i]->getcodedroite()) == $lchield[$ing]) {
                                    $t = 1;
                                }
                            }
                            if ($t == 1) {
                                break;
                            }
                            array_push($lchield, $this->getrightpartner($activer, $lchield[$i]->getcodedroite()));
                            //array_push($nar, 1);
                        }
                    }
                }
            }//fin boucle lchield
        }








        /*****droite****/
        $activer = $this->get('doctrine.orm.entity_manager')->getRepository('DLBackofficeBundle:Mlm')->findBy(array('affectation' => 1));
        $id = $request->get('id');
        $mlms = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DLBackofficeBundle:Mlm')
            ->findOneByidpartenaire($id);
        $test = false;
        if ($this->getrightpartner($activer, $activer[$c]->getcodedroite()) && $activer[$c]->getcodedroite() != 'NULL') {
            $test = true;
            array_push($rchield, $this->getrightpartner($activer, $activer[$c]->getcodedroite()));

        }
        for ($i = 0; $i < count($rchield); $i++) {

            if (!empty($rchield[$i])) {

                if ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                    if (!empty($this->getleftpartner($activer, $rchield[$i]->getcodegauche())) &&
                        !empty($this->getrightpartner($activer, $rchield[$i]->getcodedroite()))) {
                        $t = 0;
                        for ($ing = 0; $ing < count($rchield); $ing++) {
                            if ($this->getleftpartner($activer, $rchield[$i]->getcodegauche()) == $rchield[$ing] ||
                                $this->getrightpartner($activer, $rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                $t = 1;
                            }
                        }
                        if ($t == 1) {
                            break;
                        }
                        array_push($rchield, $this->getleftpartner($activer, $rchield[$i]->getcodegauche()));
                        array_push($rchield, $this->getrightpartner($activer, $rchield[$i]->getcodedroite()));
                    }

                } elseif ($rchield[$i]->getcodegauche() != 'NULL' && !($rchield[$i]->getcodedroite() == 'NULL')) {
                    if (!empty($this->getleftpartner($activer, $rchield[$i]->getcodegauche()))) {
                        $t = 0;
                        for ($ing = 0; $ing < count($rchield); $ing++) {
                            if ($this->getleftpartner($activer, $rchield[$i]->getcodegauche()) == $rchield[$ing]) {
                                $t = 1;
                            }
                        }
                        if ($t == 1) {
                            break;
                        }
                        array_push($rchield, $this->getleftpartner($activer, $rchield[$i]->getcodegauche()));
                    }
                } elseif ($rchield[$i]->getcodegauche() == 'NULL' && !($rchield[$i]->getcodedroite() != 'NULL')) {
                    if (!empty($this->getrightpartner($activer, $rchield[$i]->getcodedroite()))) {
                        $t = 0;
                        for ($ing = 0; $ing < count($rchield); $ing++) {
                            if (
                                $this->getrightpartner($activer, $rchield[$i]->getcodedroite()) == $rchield[$ing]) {
                                $t = 1;
                            }
                        }
                        if ($t == 1) {
                            break;
                        }
                        array_push($rchield, $this->getrightpartner($activer, $rchield[$i]->getcodedroite()));
                    }
                }
            }
        }//fin boucle rchield*/


        return $this->render('', array('rchield' => $rchield, 'lchield' => $lchield));
    }


public function getmyinfo($id)
{
    $user = $this->get('doctrine.orm.entity_manager')
        ->getRepository('DLUserBundle:User')
        ->find($id);
    return $user;
}

public function getleftpartner($tab,$i){
    for($c=0;$c<count($tab);$c++){
        if($i==$tab[$c]->getCodegauche()){
            return $tab[$c];
        }
    }
    return null;
}
public function getrightpartner($tab,$i){
    for($c=0;$c<count($tab);$c++){
        if($i==$tab[$c]->getCodedroite()){
            return $tab[$c];
        }
    }
    return null;
}

