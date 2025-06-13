<?php

namespace App\Repository;

use App\Entity\Commandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commandes>
 */
class CommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandes::class);
    }

   /**
   * @return Commandes[] Returns an array of Commandes objects
   * */

 
    public function findCommandesParClientVehicule(): array
    {
        $result = $this->createQueryBuilder('c')
        ->select('c.id_vehicule')
        ->getQuery()
        ->getArrayResult();
        return array_column($result, 'id_vehicule');
    }

    public function totalConfirme(): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.confirmer = :val')
            ->setParameter('val', 'confirmer')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function vue(): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.confirmer = :val')
            ->setParameter('val', 'vue')
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    public function totalxxx(): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.confirmer = :val')
            ->setParameter('val', 'xxx')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function commandeConditionVehicule($vehiculeId): array
    {
        $sd = $this->createQueryBuilder('c');
        if($sd !== null){
            $sd ->where('c.id_vehicule = :vehiculeId')
            ->setParameter('vehiculeId', $vehiculeId);
        }
         return   $sd ->getQuery()->getResult();
    }
   

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

//    public function findOneBySomeField($value): ?Commandes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
