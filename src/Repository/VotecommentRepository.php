<?php

namespace App\Repository;

use App\Entity\Votecomment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Votecomment>
 *
 * @method Votecomment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Votecomment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Votecomment[]    findAll()
 * @method Votecomment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotecommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Votecomment::class);
    }

    public function save(Votecomment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Votecomment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function isliked($userid,$commentid): int
    {


        return $this->createQueryBuilder('v')

            ->select('COUNT(v)')
            ->andWhere('v.votenb = :val')
            ->setParameter('val', 1)
            ->andWhere('v.userid = :userid')
            ->setParameter('userid', $userid)
            ->andWhere('v.commentid = :commentid')
            ->setParameter('commentid', $commentid)

            ->getQuery()

            ->getSingleScalarResult();



    }

    public function isdisliked($userid,$commentid): int
    {
        return $this->createQueryBuilder('v')

            ->select('COUNT(v)')
            ->andWhere('v.votenb = :val')
            ->setParameter('val', -1)
            ->andWhere('v.userid = :userid')
            ->setParameter('userid', $userid)
            ->andWhere('v.commentid = :commentid')
            ->setParameter('commentid', $commentid)

            ->getQuery()

            ->getSingleScalarResult();





    }


    public function changetolike($userid,$commentid):void
    {


        $this->createQueryBuilder('u')
            ->update('App\Entity\Votecomment','u')
            ->set('u.votenb', '1')
            ->Where('u.userid = :userid')
            ->andwhere('u.commentid = :commentid')
            ->setParameter('userid', $userid)
            ->setParameter('commentid', $commentid)->getQuery()->execute()

        ;





    }

    public function changetodislike($userid,$commentid):void
    {


        $this->createQueryBuilder('u')
            ->update('App\Entity\Votecomment','u')
            ->set('u.votenb', '-1')
            ->Where('u.userid = :userid')
            ->andwhere('u.commentid = :commentid')
            ->setParameter('userid', $userid)->setParameter('commentid', $commentid)->getQuery()->execute()

        ;





    }

















//    /**
//     * @return Votecomment[] Returns an array of Votecomment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Votecomment
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
