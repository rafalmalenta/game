<?php

namespace App\Repository;

use App\Entity\HeroItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeroItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroItems[]    findAll()
 * @method HeroItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroItems::class);
    }

    // /**
    //  * @return HeroItems[] Returns an array of HeroItems objects
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
    public function findOneBySomeField($value): ?HeroItems
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
