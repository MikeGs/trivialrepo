<?php

namespace App\Repository;

use App\Entity\Dificultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dificultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dificultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dificultat[]    findAll()
 * @method Dificultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DificultatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dificultat::class);
    }

    // /**
    //  * @return Dificultat[] Returns an array of Dificultat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dificultat
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
