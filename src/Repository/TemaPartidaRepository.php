<?php

namespace App\Repository;

use App\Entity\TemaPartida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TemaPartida|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemaPartida|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemaPartida[]    findAll()
 * @method TemaPartida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemaPartidaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TemaPartida::class);
    }

    // /**
    //  * @return TemaPartida[] Returns an array of TemaPartida objects
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
    public function findOneBySomeField($value): ?TemaPartida
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
