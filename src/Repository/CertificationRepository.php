<?php

namespace App\Repository;

use App\Entity\Certification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Certification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Certification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Certification[]    findAll()
 * @method Certification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CertificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Certification::class);
    }

    // /**
    //  * @return Certification[] Returns an array of Certification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function getNbTests() : array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql='SELECT c.libelle , COUNT(t.id) as nbTests FROM certification c LEFT JOIN test t ON t.certification_id = c.id GROUP BY c.libelle';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*
    public function findOneBySomeField($value): ?Certification
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
