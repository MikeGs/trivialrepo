<?php

namespace App\Repository;

use App\Entity\Usuari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Usuari|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuari|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuari[]    findAll()
 * @method Usuari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Usuari::class);
    }

    // /**
    //  * @return Usuari[] Returns an array of Usuari objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usuari
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
