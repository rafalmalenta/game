<?php

namespace App\Repository;

use App\Entity\GearType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GearType|null find($id, $lockMode = null, $lockVersion = null)
 * @method GearType|null findOneBy(array $criteria, array $orderBy = null)
 * @method GearType[]    findAll()
 * @method GearType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GearTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GearType::class);
    }

    // /**
    //  * @return GearType[] Returns an array of GearType objects
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
    public function findOneBySomeField($value): ?GearType
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
