<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    // /**
    //  * @return Users[] Returns an array of Users objects
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
    public function findOneBySomeField($value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function Login($mail,$psd){
        return $this->createQueryBuilder('u')
            ->select('u.id,u.email')
            ->andWhere('u.email = :email AND u.password = :psd')
            ->setParameter(':email',$mail)
            ->setParameter(':psd',$psd)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findmail($mail){
        return $this->createQueryBuilder('u')
            ->select('u.id,u.email')
            ->andWhere('u.email = :email')
            ->setParameter(':email',$mail)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
