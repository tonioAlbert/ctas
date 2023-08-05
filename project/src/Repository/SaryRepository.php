<?php

namespace App\Repository;

use App\Entity\Sary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sary>
 *
 * @method Sary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sary[]    findAll()
 * @method Sary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sary::class);
    }

//    /**
//     * @return Sary[] Returns an array of Sary objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sary
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
