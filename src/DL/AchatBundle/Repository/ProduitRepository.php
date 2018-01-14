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

}