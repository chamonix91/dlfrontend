<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 11/12/2017
 * Time: 15:28
 */

namespace DL\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="mlm")

 */
class Mlm
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idpartenaire=0;

    /**
     * @ORM\Column(type="string")
     */
    private $codeparent="";


    /**
     * @ORM\Column(type="string")
     */
    private $codedirect="";

    /**
     * @ORM\Column(type="integer")
     */
    private $paqueid=0;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateaffectation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $affectation=false;

    /**
     * @ORM\Column(type="string")
     */
    private $codegauche="";

    /**
     * @ORM\Column(type="string")
     */
    private $codedroite="";


    /**
     * @ORM\Column(type="boolean")
     */
    private $active=false;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrepartenairegauche=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrepartenairedroite=0;

    /**
     * Mlm constructor.
     */
    public function __construct()
    {
        $this->datecreation = new \DateTime('now');
        $this->dateaffectation = new \DateTime('now');
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdpartenaire()
    {
        return $this->idpartenaire;
    }

    /**
     * @param mixed $idpartenaire
     */
    public function setIdpartenaire($idpartenaire)
    {
        $this->idpartenaire = $idpartenaire;
    }



    /**
     * @return mixed
     */
    public function getCodeparent()
    {
        return $this->codeparent;
    }

    /**
     * @param mixed $codeparent
     */
    public function setCodeparent($codeparent)
    {
        $this->codeparent = $codeparent;
    }

    /**
     * @return mixed
     */
    public function getCodedirect()
    {
        return $this->codedirect;
    }

    /**
     * @param mixed $codedirect
     */
    public function setCodedirect($codedirect)
    {
        $this->codedirect = $codedirect;
    }

    /**
     * @return mixed
     */
    public function getPaqueid()
    {
        return $this->paqueid;
    }

    /**
     * @param mixed $paqueid
     */
    public function setPaqueid($paqueid)
    {
        $this->paqueid = $paqueid;
    }

    /**
     * @return mixed
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param mixed $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = new DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getDateaffectation()
    {
        return $this->dateaffectation;
    }

    /**
     * @param mixed $dateaffectation
     */
    public function setDateaffectation($dateaffectation)
    {
        $this->dateaffectation = new DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @param mixed $affectation
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;
    }

    /**
     * @return mixed
     */
    public function getCodegauche()
    {
        return $this->codegauche;
    }

    /**
     * @param mixed $codegauche
     */
    public function setCodegauche($codegauche)
    {
        $this->codegauche = $codegauche;
    }

    /**
     * @return mixed
     */
    public function getCodedroite()
    {
        return $this->codedroite;
    }

    /**
     * @param mixed $codedroite
     */
    public function setCodedroite($codedroite)
    {
        $this->codedroite = $codedroite;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getNbrepartenairegauche()
    {
        return $this->nbrepartenairegauche;
    }

    /**
     * @param mixed $nbrepartenairegauche
     */
    public function setNbrepartenairegauche($nbrepartenairegauche)
    {
        $this->nbrepartenairegauche = $nbrepartenairegauche;
    }

    /**
     * @return mixed
     */
    public function getNbrepartenairedroite()
    {
        return $this->nbrepartenairedroite;
    }

    /**
     * @param mixed $nbrepartenairedroite
     */
    public function setNbrepartenairedroite($nbrepartenairedroite)
    {
        $this->nbrepartenairedroite = $nbrepartenairedroite;
    }




}