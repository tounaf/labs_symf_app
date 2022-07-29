<?php

namespace App\Repository;

use App\Entity\TypeCollectionFond;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeCollectionFond>
 *
 * @method TypeCollectionFond|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCollectionFond|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCollectionFond[]    findAll()
 * @method TypeCollectionFond[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCollectionFondRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCollectionFond::class);
    }

    public function add(TypeCollectionFond $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeCollectionFond $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeCollectionFond[] Returns an array of TypeCollectionFond objects
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

//    public function findOneBySomeField($value): ?TypeCollectionFond
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
