<?php

namespace App\Repository;

use App\Entity\Completed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Completed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Completed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Completed[]    findAll()
 * @method Completed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompletedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Completed::class);
    }

    // /**
    //  * @return Completed[] Returns an array of Completed objects
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
    public function findOneBySomeField($value): ?Completed
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
