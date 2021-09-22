<?php

namespace App\Repository;

use App\Entity\EquipementsAnnonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipementsAnnonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipementsAnnonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipementsAnnonces[]    findAll()
 * @method EquipementsAnnonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipementsAnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipementsAnnonces::class);
    }

    // /**
    //  * @return EquipementsAnnonces[] Returns an array of EquipementsAnnonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquipementsAnnonces
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
