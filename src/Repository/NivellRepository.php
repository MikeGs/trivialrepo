<?php

namespace App\Repository;

use App\Entity\Nivell;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Nivell|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nivell|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nivell[]    findAll()
 * @method Nivell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NivellRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nivell::class);
    }

    // /**
    //  * @return Nivell[] Returns an array of Nivell objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nivell
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
