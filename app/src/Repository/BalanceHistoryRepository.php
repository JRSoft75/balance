<?php

namespace App\Repository;

use App\Entity\BalanceHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BalanceHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method BalanceHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method BalanceHistory[]    findAll()
 * @method BalanceHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BalanceHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BalanceHistory::class);
    }

    public function getHistory($limit)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.created_at', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // /**
    //  * @return BalanceHistory[] Returns an array of BalanceHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BalanceHistory
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
