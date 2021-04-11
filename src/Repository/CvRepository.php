<?php

namespace App\Repository;

use App\Entity\Cv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cv[]    findAll()
 * @method Cv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cv::class);
    }

    /**
     * @return Cv[] Returns an array of Evenement objects
     */

    public function findSearchCv($categoryType)
    {
        return $this->createQueryBuilder('e')

            ->andWhere('e.categoryType = :categoryType')
            ->setParameter('categoryType', $categoryType)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCategory($name)
    {

        return $this->createQueryBuilder('e')
            ->andWhere('e.name Like :name')
            ->setParameter('name', '%'.$name.'%')
            ->getQuery()
            ->getResult()
            ;
    }
    public function sortByName()
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')


            ->orderBy('p.name', 'ASC');


        $query = $qb->getQuery();

        return $query->execute();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }

    // /**
    //  * @return Cv[] Returns an array of Cv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cv
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
