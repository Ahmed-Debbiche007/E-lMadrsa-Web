<?php

namespace App\Repository;


use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function adjustlike($postid, $postvotefinal): void
    {

        $this->createQueryBuilder('u')
            ->update('App\Entity\Post', 'u')
            ->set('u.postvote', $postvotefinal)
            ->where('u.postid = :postid')
            ->setParameter('postid', $postid)->getQuery()->execute();


    }




    public function mostlikedusers(): array
    {
        $em = $this->getEntityManager();
        return $em->createQuery('SELECT u.username, SUM(p.postvote) as s from App\Entity\User u JOIN App\Entity\Post p WITH u.id = p.user GROUP BY u.username ORDER BY s DESC ')

            ->setMaxResults(3)
            ->getResult();
    }

    /* public function getPostsByCategory(Category $entity)  {
         $id=$entity.getCategoryid();
         $qb= $this->createQueryBuilder('p')
             ->where('p.id=:id')
             ->setParameter('id',$id);
         return $qb->getQuery()
             ->getResult();
     }
 //    /**
 //     * @return Post[] Returns an array of Post objects
 //     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
