<?php

namespace App\Repository;

use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Boolean;
use function PHPUnit\Framework\isNull;

/**
 * @extends ServiceEntityRepository<Vote>
 *
 * @method Vote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vote[]    findAll()
 * @method Vote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vote::class);
    }

    public function save(Vote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function isliked($userid,$postid): int
    {


        return $this->createQueryBuilder('v')

            ->select('COUNT(v)')
            ->andWhere('v.votenb = :val')
            ->setParameter('val', 1)
            ->andWhere('v.userid = :userid')
            ->setParameter('userid', $userid)
            ->andWhere('v.postid = :postid')
            ->setParameter('postid', $postid)

            ->getQuery()

            ->getSingleScalarResult();



    }

    public function isdisliked($userid,$postid): int
    {
        return $this->createQueryBuilder('v')

            ->select('COUNT(v)')
            ->andWhere('v.votenb = :val')
            ->setParameter('val', -1)
            ->andWhere('v.userid = :userid')
            ->setParameter('userid', $userid)
            ->andWhere('v.postid = :postid')
            ->setParameter('postid', $postid)

            ->getQuery()

            ->getSingleScalarResult();





    }


    public function changetolike($userid,$postid):void
    {


        $this->createQueryBuilder('u')->update('App\Entity\Vote','u')->set('u.votenb', '1')->Where('u.userid = :userid')->andwhere('u.postid = :postid')->setParameter('userid', $userid)->setParameter('postid', $postid)->getQuery()->execute()






    ;





    }


    public function changetodislike($userid,$postid):void
    {


        $this->createQueryBuilder('u')
            ->update('App\Entity\Vote','u')
            ->set('u.votenb', '-1')
            ->Where('u.userid = :userid')
            ->andwhere('u.postid = :postid')
            ->setParameter('userid', $userid)->setParameter('postid', $postid)->getQuery()->execute()

        ;





    }

    public function changetoNull($userid,$postid):void
    {


        $this->createQueryBuilder('u')
            ->update('App\Entity\Vote','u')
            ->set('u.votenb', '0')
            ->Where('u.userid = :userid')
            ->andwhere('u.postid = :postid')
            ->setParameter('userid', $userid)->setParameter('postid', $postid)->getQuery()->execute()

        ;





    }
//    /**
//     * @return Vote[] Returns an array of Vote objects
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

//    public function findOneBySomeField($value): ?Vote
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
