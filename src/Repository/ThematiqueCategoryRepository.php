<?php

namespace App\Repository;

use App\Entity\ThematiqueCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThematiqueCategory>
 *
 * @method ThematiqueCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThematiqueCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThematiqueCategory[]    findAll()
 * @method ThematiqueCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThematiqueCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThematiqueCategory::class);
    }

    public function add(ThematiqueCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ThematiqueCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ThematiqueCategory[] Returns an array of ThematiqueCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThematiqueCategory
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
