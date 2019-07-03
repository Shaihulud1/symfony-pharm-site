<?php

namespace App\Repository;

use App\Entity\AboutLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AboutLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutLogo[]    findAll()
 * @method AboutLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutLogoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AboutLogo::class);
    }

    // /**
    //  * @return AboutLogo[] Returns an array of AboutLogo objects
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
    public function findOneBySomeField($value): ?AboutLogo
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
