<?php

namespace App\Repository;

use App\Entity\RendezVous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RendezVous|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVous|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVous[]    findAll()
 * @method RendezVous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVous::class);
    }

    // /**
    //  * @return RendezVous[] Returns an array of RendezVous objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RendezVous
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function orderbymail(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('select r from App\Entity\RendezVous r order by r.date ASC ');
        return $query->getResult();
    }
    public function listrendezvousparsurfer($id){
        return $this->createQueryBuilder('r')->join('r.mail','s')->addSelect('s')
            ->where('s.id=:id')->setParameter('id',$id)->getQuery()->getResult();
    }

    /**
     * @param $meet
     * @return int|mixed|string
     */
    public function findrdvBydate($meet)
    {
        return $this->createQueryBuilder('r')
            ->where('r.date Like :date')
            ->setParameter('date', '%'.$meet.'%')
            ->getQuery()
            ->getResult()
            ;
    }

}
