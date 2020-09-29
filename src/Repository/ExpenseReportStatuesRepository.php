<?php

namespace App\Repository;

use App\Entity\ExpenseReportStatues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExpenseReportStatues|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpenseReportStatues|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpenseReportStatues[]    findAll()
 * @method ExpenseReportStatues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseReportStatuesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpenseReportStatues::class);
    }

    // /**
    //  * @return ExpenseReportStatues[] Returns an array of ExpenseReportStatues objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExpenseReportStatues
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
