<?php

namespace App\Repository;

use App\Entity\AppendixType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AppendixType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppendixType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppendixType[]    findAll()
 * @method AppendixType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppendixTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppendixType::class);
    }

    // /**
    //  * @return AppendixType[] Returns an array of AppendixType objects
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
    public function findOneBySomeField($value): ?AppendixType
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
