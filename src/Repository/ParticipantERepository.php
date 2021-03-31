<?php

namespace App\Repository;

use App\Entity\ParticipantE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParticipantE|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipantE|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipantE[]    findAll()
 * @method ParticipantE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipantE::class);
    }
    /**
     * @return ParticipantE[] Returns an array of Evenement objects
     */

    public function age()
    {
        return $this->createQueryBuilder('e')
            ->select('e.age,COUNT(e.age) as Nb')
            ->groupBy('e.age')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ParticipantE[] Returns an array of ParticipantE objects
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
    public function findOneBySomeField($value): ?ParticipantE
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
