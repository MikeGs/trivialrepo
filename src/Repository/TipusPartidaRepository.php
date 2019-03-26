<?php

namespace App\Repository;

use App\Entity\TipusPartida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipusPartida|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipusPartida|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipusPartida[]    findAll()
 * @method TipusPartida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipusPartidaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipusPartida::class);
    }

    // /**
    //  * @return TipusPartida[] Returns an array of TipusPartida objects
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
    public function findOneBySomeField($value): ?TipusPartida
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
