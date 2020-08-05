<?php

namespace App\Repository;

use App\Entity\Youtubeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Youtubeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Youtubeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Youtubeur[]    findAll()
 * @method Youtubeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YoutubeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Youtubeur::class);
    }

    // /**
    //  * @return Youtubeur[] Returns an array of Youtubeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Youtubeur
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
