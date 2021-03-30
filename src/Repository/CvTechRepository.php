<?php

namespace App\Repository;

use App\Entity\CvTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CvTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvTech[]    findAll()
 * @method CvTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvTechRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CvTech::class);
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

