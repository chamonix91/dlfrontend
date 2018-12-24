<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 14/01/2018
 * Time: 21:06
 */

namespace DL\AchatBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProduitRepository extends EntityRepository
{
    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('u')
            ->Select('u')
            ->Where('u.id IN (:array)')
            ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
    }

    public function findByStock() {

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('r')
            ->from('DLAchatBundle:Produit', 'r')
            ->where('r.quantite > :quantite')
            ->setParameters(array('quantite'=> 1));
        $query = $qb->getQuery();
        $produit = $query->getResult();
        return $produit;


    }

}