<?php

namespace App\Repository;

use App\Entity\AboutImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AboutImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutImage[]    findAll()
 * @method AboutImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AboutImage::class);
    }

    // /**
    //  * @return AboutImage[] Returns an array of AboutImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AboutImage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
