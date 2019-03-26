<?php

namespace App\Repository;

use App\Entity\Opinio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Opinio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opinio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opinio[]    findAll()
 * @method Opinio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpinioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Opinio::class);
    }

    // /**
    //  * @return Opinio[] Returns an array of Opinio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Opinio
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
