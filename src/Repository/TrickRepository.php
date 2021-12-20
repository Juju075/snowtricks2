<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }
    

    /**
     * Retourne toute les tricks par page
     * @return void
    */    
    public function getPaginationTricks($page, $limit){ //dump 1 et 2
        dd($page, $limit);
        //creating a QueryBuilder instance 
        //https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/query-builder.html

        $query = $this->createQueryBuilder('a') //a 
        //->where('a.active = 1 ') //ne pas mettre bdd champs active 1
        ->orderBy('a.created_at')
        ->setFirstResult(($page * $limit)-$limit)
        ->setMaxResults($limit)
        ;
        //requete prepare->execute
        return $query->getQuery->getResult();
    }

    /**
     * Retourne le nombre total de tricks
     * @return void
     */
    public function getTotalTricks(){
        $query = $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->WHERE('a.active = 1')
        ;  
        //return $query->getQuery->getResult(); obtien un []
        return $query->getQuery->getSingleScalarResult();
    }

    // /**
    //  * @return Trick[] Returns an array of Trick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trick
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
