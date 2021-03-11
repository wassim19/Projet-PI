<?php

namespace App\Repository;

use App\Entity\NotifEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NotifEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotifEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotifEvent[]    findAll()
 * @method NotifEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotifEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotifEvent::class);
    }

    // /**
    //  * @return NotifEvent[] Returns an array of NotifEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotifEvent
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
