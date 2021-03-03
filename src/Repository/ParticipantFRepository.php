<?php

namespace App\Repository;

use App\Entity\Participantf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participantf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participantf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participantf[]    findAll()
 * @method Participantf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participantf::class);
    }

    // /**
    //  * @return Participantf[] Returns an array of Participantf objects
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
    public function findOneBySomeField($value): ?Participantf
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
