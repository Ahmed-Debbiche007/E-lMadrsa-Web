<?php

namespace App\Repository;

use App\Entity\Tutorshipsessions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tutorshipsessions>
 *
 * @method Tutorshipsessions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tutorshipsessions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tutorshipsessions[]    findAll()
 * @method Tutorshipsessions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorshipSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tutorshipsessions::class);
    }

    public function save(Tutorshipsessions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tutorshipsessions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Tutorshipsessions[] Returns an array of Tutorshipsessions objects
//     */
   public function findLatest(): ?Tutorshipsessions
   {
       return $this->createQueryBuilder('t')
           ->orderBy('t.id', 'DESC')
           ->setMaxResults(1)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

   public function getSessions($id): array
   {
       return $this->createQueryBuilder('t')
            ->where('t.idStudent = :val')
            ->orWhere('t.idTutor = :val')
           ->setParameter('val', $id)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Tutorshipsessions
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
