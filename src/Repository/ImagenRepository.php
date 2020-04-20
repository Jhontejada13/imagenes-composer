<?php

namespace App\Repository;

use App\Entity\Imagen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imagen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imagen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imagen[]    findAll()
 * @method Imagen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imagen::class);
    }



    // /**
    //  * @return Imagen[] Returns an array of Imagen objects
    //  */

    public function getImageByName($order){
        
        $queryBuilder = $this->createQueryBuilder('i')
        ->andWhere("i.nombre = :nombre")
        ->setParameter('nombre', 'imagen3')
        ->getQuery();
        $resultset = $queryBuilder->execute();

        return $resultset;
    }

    /*
    public function findByExampleField($value)
    {
        //DQL -> Lenguaje propio de doctrine para ejecutar sentencias sql
        $imagen_repo = $this->getDoctrine()->getRepository(Imagen::class);
        $dql = "SELECT a FROM App\Entity\Imagen a WHERE a.nombre = 'imagen3'";
        $query = $imagen_repo->createQuery($dql);
        $resultset = $query->execute();
        var_dump($resultset);

        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imagen
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    
}
