<?php

namespace App\Repository;

use App\Entity\Tomobiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<Tomobiles>
 */
class TomobilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tomobiles::class);
    }

   /**
    * @return Tomobiles[] Returns an array of Tomobiles objects
    */

    public function ConditionType(): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.type')
            ->getQuery()
            ->getScalarResult(); // Cela retourne un tableau de types uniquement
    }
    
    public function Conditioncates(): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.prix')
            ->orderBy('r.prix', 'ASC') // optionnel
            ->getQuery()
            ->getScalarResult();
    }
    
    public function ConditionCategorie(): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.categorie')
            ->orderBy('r.categorie', 'ASC') // optionnel
            ->getQuery()
            ->getScalarResult();
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
    public function vehiculePro($act)
    {
        $qb = $this->createQueryBuilder('r');
    
        if ($act !== null) {
            $qb->where('r.proprietaire = :act')
               ->setParameter('act', $act);
        }
    
        return $qb->getQuery()->getResult();
    }

//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tomobiles
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
