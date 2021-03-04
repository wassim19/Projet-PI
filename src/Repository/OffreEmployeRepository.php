<?php

namespace App\Repository;

use App\Entity\OffreEmploye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreEmploye|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreEmploye|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreEmploye[]    findAll()
 * @method OffreEmploye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreEmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreEmploye::class);
    }

    // /**
    //  * @return OffreEmploye[] Returns an array of OffreEmploye objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreEmploye
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
