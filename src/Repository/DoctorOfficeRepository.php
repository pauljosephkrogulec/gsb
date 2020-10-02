<?php

namespace App\Repository;

use App\Entity\DoctorOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DoctorOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctorOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctorOffice[]    findAll()
 * @method DoctorOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctorOffice::class);
    }

    // /**
    //  * @return DoctorOffice[] Returns an array of DoctorOffice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctorOffice
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
