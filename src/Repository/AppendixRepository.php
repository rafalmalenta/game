<?php

namespace App\Repository;

use App\Entity\Appendix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Appendix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appendix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appendix[]    findAll()
 * @method Appendix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppendixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appendix::class);
    }

    // /**
    //  * @return Appendix[] Returns an array of Appendix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appendix
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
