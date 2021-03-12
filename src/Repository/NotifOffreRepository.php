<?php

namespace App\Repository;

use App\Entity\NotifOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NotifOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotifOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotifOffre[]    findAll()
 * @method NotifOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotifOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotifOffre::class);
    }

    // /**
    //  * @return NotifOffre[] Returns an array of NotifOffre objects
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
    public function findOneBySomeField($value): ?NotifOffre
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
