<?php

namespace App\Repository;

use App\Entity\EnemyPrototype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnemyPrototype|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnemyPrototype|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnemyPrototype[]    findAll()
 * @method EnemyPrototype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnemyPrototypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnemyPrototype::class);
    }

    // /**
    //  * @return EnemyPrototype[] Returns an array of EnemyPrototype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnemyPrototype
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
