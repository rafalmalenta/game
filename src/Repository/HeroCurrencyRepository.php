<?php

namespace App\Repository;

use App\Entity\HeroCurrency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeroCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroCurrency[]    findAll()
 * @method HeroCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroCurrency::class);
    }

    // /**
    //  * @return HeroCurrency[] Returns an array of HeroCurrency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroCurrency
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
