<?php

namespace App\Repository;

use App\Entity\Grup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Grup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grup[]    findAll()
 * @method Grup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Grup::class);
    }

    public function getAlumnesCurs($idCurs) {
        
        //$em = $this->getDoctrine()->getManager();

            //$connection = $em->getConnection();

            $alumnes = $this->createQueryBuilder('g')
                ->getQuery()
                ->getResult()
            ;

            var_dump($alumnes);

            /*$statement = $this->prepare("SELECT gu.grup_id, gu.usuari_id, u.nom, u.cognoms, u.last_login from grup_usuari gu inner join usuari u on gu.usuari_id = u.id 
            where gu.grup_id = " . $idCurs);
            $statement->execute();
            $alumnes = $statement->fetchAll();*/

            return $alumnes;
    }

    // /**
    //  * @return Grup[] Returns an array of Grup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grup
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
