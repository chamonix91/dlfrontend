<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 11/01/2018
 * Time: 11:25
 */
namespace DL\UserBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Ramsey\Uuid\Uuid;

/**
 * {@inheritdoc}
 */
class CodeGenerator extends AbstractIdGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate(EntityManager $em, $entity)
    {
        $uuid = Uuid::uuid4()->getHex();

        if (null !== $em->getRepository(get_class($entity))->findOneBy(['code' => $uuid])) {
            $uuid = $this->generate($em, $entity);
        }

        return $uuid;
    }
}