<?php

namespace App\Repository;

use App\Entity\LoisirsAnnonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LoisirsAnnonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoisirsAnnonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoisirsAnnonces[]    findAll()
 * @method LoisirsAnnonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoisirsAnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoisirsAnnonces::class);
    }

    // /**
    //  * @return LoisirsAnnonces[] Returns an array of LoisirsAnnonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LoisirsAnnonces
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
