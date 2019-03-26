<?php

namespace App\Repository;

use App\Entity\PreguntaPartida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PreguntaPartida|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreguntaPartida|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreguntaPartida[]    findAll()
 * @method PreguntaPartida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreguntaPartidaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PreguntaPartida::class);
    }

    // /**
    //  * @return PreguntaPartida[] Returns an array of PreguntaPartida objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PreguntaPartida
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
