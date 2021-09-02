<?php

namespace App\Repository;

use App\Entity\LootTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LootTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method LootTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method LootTable[]    findAll()
 * @method LootTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LootTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LootTable::class);
    }

    // /**
    //  * @return LootTable[] Returns an array of LootTable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LootTable
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
