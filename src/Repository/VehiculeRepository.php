<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicule>
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }
       
    /**
    * @return Vehicule[] Returns an array of Vehicule objects
    */

    public function ConditionType(){

        return  $this->createQueryBuilder('r')
        ->groupBy('r.type')
        ->getQuery()
        ->getResult(); 

    }

    public function Conditioncate(){

        return  $this->createQueryBuilder('r')
        ->groupBy('r.prix')
        ->getQuery()
        ->getResult(); 

    }

    public function ConditionCategorie(){

        return  $this->createQueryBuilder('r')
        ->groupBy('r.categorie')
        ->getQuery()
        ->getResult(); 
    }


    public function ConditionVehiculeFilterType(?string $type = null){

        $filter = $this->createQueryBuilder('r');
        if ($type !== null) {
            $filter->where('r.type = :cat')
            ->setParameter('cat', $type);
        }
        return $filter->getQuery()->getResult();

    }
    public function ConditionVehiculeFilterCategorie(?string $categorie = null){

        $filter = $this->createQueryBuilder('r');
        if ($categorie !== null) {
            $filter->where('r.categorie = :cat')
            ->setParameter('cat', $categorie);
        }
        return $filter->getQuery()->getResult();

    }

    public function ConditionVehiculeFilterPrix(?string $prix = null){

        $filter = $this->createQueryBuilder('r');
        if ($prix !== null) {
            $filter->where('r.prix = :cat')
            ->setParameter('cat', $prix);
        }
        return $filter->getQuery()->getResult();

    }
    
//    /**
//     * @return Vehicule[] Returns an array of Vehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicule
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
