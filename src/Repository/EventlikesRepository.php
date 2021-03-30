<?php

namespace App\Repository;

use App\Entity\Eventlikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Eventlikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eventlikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eventlikes[]    findAll()
 * @method Eventlikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventlikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eventlikes::class);
    }

    // /**
    //  * @return Eventlikes[] Returns an array of Eventlikes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eventlikes
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
