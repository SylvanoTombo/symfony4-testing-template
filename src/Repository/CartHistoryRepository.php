<?php

namespace App\Repository;

use App\Entity\CartHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CartHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartHistory[]    findAll()
 * @method CartHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartHistory::class);
    }

    // /**
    //  * @return CartHistory[] Returns an array of CartHistory objects
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
    public function findOneBySomeField($value): ?CartHistory
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
