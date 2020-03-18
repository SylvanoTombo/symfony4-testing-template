<?php

namespace App\Repository;

use App\Entity\VoucherHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VoucherHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoucherHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoucherHistory[]    findAll()
 * @method VoucherHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoucherHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoucherHistory::class);
    }

    // /**
    //  * @return VoucherHistory[] Returns an array of VoucherHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoucherHistory
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
