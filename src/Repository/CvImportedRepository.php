<?php

namespace App\Repository;

use App\Entity\CvImported;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CvImported|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvImported|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvImported[]    findAll()
 * @method CvImported[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvImportedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CvImported::class);
    }

    // /**
    //  * @return CvImported[] Returns an array of CvImported objects
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
    public function findOneBySomeField($value): ?CvImported
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
