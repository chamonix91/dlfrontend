<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 12/12/2017
 * Time: 11:35
 */

namespace DL\AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DL\AchatBundle\Repository\ProduitRepository")
 * @ORM\Table(name="produit")
 */
class Produit
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="DL\AchatBundle\Entity\Categorie")
     * @ORM\JoinColumn(name="idcategory", referencedColumnName="id", onDelete="CASCADE")
     */
    private $idcategory;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $shortdescription;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $codeProduit;



    /**
     * @ORM\Column(type="integer" ,nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $image1;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $image2;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $image3;


    /**
     * @ORM\Column(type="integer" ,nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $categorie;
    /**
     * @ORM\Column(type="text" ,nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    private $souscategorie;

    /**
     * @ORM\Column(type="integer" ,nullable=true)
     */
    private $remise;



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
    public function getIdcategory()
    {
        return $this->idcategory;
    }

    /**
     * @param mixed $idcategory
     */
    public function setIdcategory($idcategory)
    {
        $this->idcategory = $idcategory;
    }

    /**
     * @return mixed
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
    }

    /**
     * @param mixed $shortdescription
     */
    public function setShortdescription($shortdescription)
    {
        $this->shortdescription = $shortdescription;
    }

    /**
     * @return mixed
     */
    public function getCodeProduit()
    {
        return $this->codeProduit;
    }

    /**
     * @param mixed $codeProduit
     */
    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    }







    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param mixed $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return mixed
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param mixed $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return mixed
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param mixed $image3
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getSouscategorie()
    {
        return $this->souscategorie;
    }

    /**
     * @param mixed $souscategorie
     */
    public function setSouscategorie($souscategorie)
    {
        $this->souscategorie = $souscategorie;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * @param mixed $remise
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    }






}