<?php

namespace App\Repository;

use App\Entity\Mipetraka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mipetraka>
 *
 * @method Mipetraka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mipetraka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mipetraka[]    findAll()
 * @method Mipetraka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MipetrakaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mipetraka::class);
    }

//    /**
//     * @return Mipetraka[] Returns an array of Mipetraka objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mipetraka
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
