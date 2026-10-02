<?php

namespace App\Repository;

use App\Entity\Cavalerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cavalerie>
 */
class CavalerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cavalerie::class);
    }

    public function findChevaux(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categorie = :cat')
            ->setParameter('cat', 'cheval')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findPoneys(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categorie LIKE :cat')
            ->setParameter('cat', 'poney%')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Cavalerie[] Returns an array of Cavalerie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cavalerie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
