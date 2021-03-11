<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }


     /**
      * @return Evenement[] Returns an array of Evenement objects
      */

    public function findEvenementByTitle($title)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.title Like :title')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Evenement[] Returns an array of Evenement objects
     */

    public function sortByTitleASC()
    {
        $evenement = $this->createQueryBuilder('e')
            ->orderBy('e.title', 'ASC');
        $query = $evenement->getQuery();
        return $query->execute();
    }

    /**
     * @return Evenement[] Returns an array of Evenement objects
     */

    public function sortByTitleDESC()
    {
        $evenement = $this->createQueryBuilder('e')
            ->orderBy('e.title', 'DESC');
        $query = $evenement->getQuery();
        return $query->execute();
    }


    /*
    public function findOneBySomeField($value): ?Evenement
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
