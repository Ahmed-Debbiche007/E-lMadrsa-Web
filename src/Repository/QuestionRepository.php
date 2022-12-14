<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function save(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function get()
    {
        $qb = $this->createQueryBuilder('q')
            ->join('q.examen', 'e');
        return $qb->getQuery()->getResult();
    }


    public function getQbyEId($id)
    {
        $qb = $this->createQueryBuilder('q')
            ->join('q.examen', 'e');


        return $qb->getQuery()->getResult();
    }







//    /**
//     * @return Question[] Returns an array of Question objects
//     */
    public function findByExamsId($value): array
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.examen = :val')
            ->setParameter('val', $value)
             ->getQuery()
            ->getResult();
    }
}


//    public function findOneBySomeField($value): ?Question
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


//SELECT q,e FROM App\Entity\Question q INNER JOIN q.App\Entity\Examen e
/*
    public function get() :array {
        $rsm = new ResultSetMapping();
        $em = $this->getEntityManager();
        $query = $em->createNativeQuery('SELECT ennonce from question',$rsm);

        return $query->getResult();
    }



}
*/