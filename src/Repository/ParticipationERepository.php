<?php

namespace App\Repository;

use App\Entity\ParticipationE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParticipationE|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipationE|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipationE[]    findAll()
 * @method ParticipationE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipationE::class);
    }

    // /**
    //  * @return ParticipationE[] Returns an array of ParticipationE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParticipationE
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
