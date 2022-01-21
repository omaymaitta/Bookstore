<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByTitre($value)
    {
        return $this->createQueryBuilder('livre')
            ->andWhere('livre.titre LIKE :val')
            ->setParameter('val', '%' . $value . '%')
            ->getQuery()
            ->getResult();
    }
    public function findBetweenTwoDates($dateMin, $dateMax)
    {
        return $this->createQueryBuilder('livre')
            ->andWhere('livre.date_de_parution BETWEEN :dateMin AND :dateMax')
            ->setParameter('dateMin',  $dateMin . '-01-01')
            ->setParameter('dateMax',  $dateMax . '-12-31')
            ->getQuery()
            ->getResult();
    }
    public function findByNote($note)
    {
        return $this->createQueryBuilder('livre')
            ->andWhere('livre.note = :note')
            ->setParameter('note',  $note)
            ->getQuery()
            ->getResult();
    }
}
