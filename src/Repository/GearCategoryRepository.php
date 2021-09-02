<?php

namespace App\Repository;

use App\Entity\GearCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GearCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method GearCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method GearCategory[]    findAll()
 * @method GearCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GearCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GearCategory::class);
    }

    // /**
    //  * @return GearCategory[] Returns an array of GearCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GearCategory
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
