<?php

namespace App\Repository;

use App\Entity\Playgrounds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Jsor\Doctrine\PostGIS\Functions;

/**
 * @method Playgrounds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playgrounds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playgrounds[]    findAll()
 * @method Playgrounds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaygroundsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Playgrounds::class);
    }

    /**
     * @return Playgrounds[] Returns an array of Playground objects
     */
    
    public function Point($X1, $Y1)
    {
		$configuration = new \Doctrine\ORM\Configuration();
        $configuration->addCustomStringFunction('ST_X', 'Jsor\Doctrine\PostGIS\Functions\ST_X');
        $configuration->addCustomStringFunction('ST_Y', 'Jsor\Doctrine\PostGIS\Functions\ST_Y');
        $configuration->addCustomStringFunction('ST_Transform', 'Jsor\Doctrine\PostGIS\Functions\ST_Transform');
        $configuration->addCustomStringFunction('ST_DWithin', 'Jsor\Doctrine\PostGIS\Functions\ST_DWithin');
        $configuration->addCustomStringFunction('ST_SetSRID', 'Jsor\Doctrine\PostGIS\Functions\ST_SetSRID');
        $configuration->addCustomStringFunction('ST_Point', 'Jsor\Doctrine\PostGIS\Functions\ST_Point');
		$em = $this->getEntityManager();
	    $dql='SELECT p.name, 
    ST_X(ST_Transform(p.point,4326)) as X, 
    ST_Y(ST_Transform(p.point,4326)) as Y FROM App\Entity\Playgrounds p WHERE ST_DWithin(p.point, ST_SetSRID(ST_Point(:lng, :lat), 4326), 0.1)=true';
		$requete = $em->createQuery($dql)
					  ->setParameter('lng', $X1)
					  ->setParameter('lat', $Y1);
		return $requete->getResult();	  
    
    }
    

    /*
    public function findOneBySomeField($value): ?Playgrounds
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
