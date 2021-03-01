<?php

namespace App\Repository;

use App\Entity\Correctiontest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Correctiontest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Correctiontest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Correctiontest[]    findAll()
 * @method Correctiontest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorrectiontestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Correctiontest::class);
    }

    // /**
    //  * @return Correctiontest[] Returns an array of Correctiontest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Correctiontest
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
