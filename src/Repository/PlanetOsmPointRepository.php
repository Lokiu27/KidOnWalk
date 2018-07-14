<?php

namespace App\Repository;

use App\Entity\PlanetOsmPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlanetOsmPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanetOsmPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanetOsmPoint[]    findAll()
 * @method PlanetOsmPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetOsmPointRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlanetOsmPoint::class);
    }

   /**
     * @return PlanetOsmPoint[] Returns an array of PlanetOsmPoint objects
     */
    
    public function findByLeisure($value): ?PlanetOsmPoint
    {
      $zap=$this->createQueryBuilder();
      return $zap->select('p.osm_id')
			->from('PlanetOsmPoint', 'p')
            ->where('p.leisure = :val')
            ->setParameter('val', $value)
            ->orderBy('p.osm_id', 'ABC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
   
    
     }


    /*
    public function findOneBySomeField($value): ?PlanetOsmPoint
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
