<?php

namespace App\Repository;

use App\Entity\WearingPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WearingPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method WearingPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method WearingPlace[]    findAll()
 * @method WearingPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WearingPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WearingPlace::class);
    }

    // /**
    //  * @return WearingPlace[] Returns an array of WearingPlace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WearingPlace
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
