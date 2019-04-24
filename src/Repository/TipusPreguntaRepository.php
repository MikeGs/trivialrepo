<?php

namespace App\Repository;

use App\Entity\TipusPregunta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipusPregunta|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipusPregunta|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipusPregunta[]    findAll()
 * @method TipusPregunta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipusPreguntaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipusPregunta::class);
    }

    // /**
    //  * @return TipusPregunta[] Returns an array of TipusPregunta objects
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
    public function findOneBySomeField($value): ?TipusPregunta
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
