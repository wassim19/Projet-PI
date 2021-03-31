<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[] Returns an array of User objects
     */

    public function findEvenementByname($Username)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.Username Like :Username')
            ->setParameter('Username', '%'.$Username.'%')
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return User[] Returns an array of user objects
     */

    public function sortByTitleASC()
    {
        $user = $this->createQueryBuilder('e')
            ->orderBy('e.Username', 'ASC');
        $query = $user->getQuery();
        return $query->execute();
    }
    /**
     * @return User[] Returns an array of user objects
     */

    public function sortBynameeASC()
    {
        $user = $this->createQueryBuilder('e')
            ->orderBy('e.first_name', 'ASC');
        $query = $user->getQuery();
        return $query->execute();
    }
    /**
     * @return User[] Returns an array of user objects
     */

    public function sortByTitleDESC()
    {
        $user = $this->createQueryBuilder('s')
            ->orderBy('s.Username', 'DESC');
        $query = $user->getQuery();
        return $query->execute();
    }
    /**
     * @return User[] Returns an array of user objects
     */

    public function sortBystatusDESC()
    {
        $user = $this->createQueryBuilder('f')
            ->orderBy('f.role','DESC');
        $query = $user->getQuery();
        return $query->execute();
    }
    /**
     * @return User[] Returns an array of User objects
     */

    public function findsurferByname($first_name)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.first_name Like :first_name')
            ->setParameter('first_name', '%'.$first_name.'%')
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
