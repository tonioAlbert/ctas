<?php

namespace App\Repository;

use App\Entity\Olona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Olona>
 *
 * @method Olona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Olona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Olona[]    findAll()
 * @method Olona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OlonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Olona::class);
    }

//    /**
//     * @return Olona[] Returns an array of Olona objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Olona
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
