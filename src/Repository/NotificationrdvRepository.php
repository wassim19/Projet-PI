<?php

namespace App\Repository;

use App\Entity\Notificationrdv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Notificationrdv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notificationrdv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notificationrdv[]    findAll()
 * @method Notificationrdv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationrdvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notificationrdv::class);
    }

    // /**
    //  * @return Notificationrdv[] Returns an array of Notificationrdv objects
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
    public function findOneBySomeField($value): ?Notificationrdv
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
