<?php

namespace App\Repository;

use App\Entity\EnemyModifier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnemyModifier|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnemyModifier|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnemyModifier[]    findAll()
 * @method EnemyModifier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnemyModifierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnemyModifier::class);
    }

    // /**
    //  * @return EnemyModifier[] Returns an array of EnemyModifier objects
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
    public function findOneBySomeField($value): ?EnemyModifier
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
