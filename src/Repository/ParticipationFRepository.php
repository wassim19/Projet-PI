<?php

namespace App\Repository;

use App\Entity\ParticipationF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParticipationF|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipationF|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipationF[]    findAll()
 * @method ParticipationF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipationF::class);
    }

    // /**
    //  * @return ParticipationF[] Returns an array of ParticipationF objects
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
    public function findOneBySomeField($value): ?ParticipationF
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