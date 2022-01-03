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
    
    //creating a QueryBuilder instance requete via querybuilder
    //https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/query-builder.html
    //https://zestedesavoir.com/tutoriels/1713/doctrine-2-a-lassaut-de-lorm-phare-de-php/exploiter-une-base-de-donnees-avec-doctrine-2/a-la-rencontre-du-querybuilder-1/

    /**
     * Retourne toute les tricks par page
     * @return void
    */    
    public function getPaginatedTricks($page, $limit){

        //SELECT alias de table    
        $query = $this->createQueryBuilder('t') 
        ->orderBy('t.createdAt', 'DESC') // ref trick.php pas bdd

        //Ajout de params

        // limiter le nombre de résultat (parametres) 
        //On cree un Offset numéro du premier numéro à récupérer
        ->setFirstResult(($page * $limit)-$limit) // depart  1 *15 =15 - l
        ->setMaxResults($limit)  //limit d'elements  
        ;
        return $query->getQuery()->getResult();
    }

    /**
     * Retourne le nombre total de tricks
     * @return void
     */
    public function getTotalTricks(){
        $query = $this->createQueryBuilder('t')
            ->select('COUNT(t)')
        ;  
        return $query->getQuery()->getSingleScalarResult();
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

