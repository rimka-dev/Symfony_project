<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    // méthode de recherche avec query

    public function findAllArray($query)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.region', 'asc')
            ->innerJoin('a.user', 'u')
            ->addSelect('u')
            ->where('a.region LIKE :query')
            
            ->setParameter('query', '%' . $query . '%');
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        // return $qb->getQuery()->getArrayResult(); // Hydratation array, équivalent à la ligne du dessus
    }

    // /**
    //  * @return Annonces[] Returns an array of Annonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findLimite(){
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.date_creation', 'DESC')
            ->innerJoin('a.user', 'u')
            ->setMaxResults(4);
            return $qb->getQuery()->getResult();

    }

    /*
    public function findOneBySomeField($value): ?Annonces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
