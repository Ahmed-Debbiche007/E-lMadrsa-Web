<?php

namespace App\Repository;

use App\Entity\Examen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Examen>
 *
 * @method Examen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Examen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Examen[]    findAll()
 * @method Examen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Examen::class);
    }

    public function save(Examen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Examen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findExamsByCategorieId( int $value): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.categorie = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }

    public function countexams()
    {
        return intval($this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->getQuery()->getSingleScalarResult());
    }


/*
    public function countexamsincategorie()
    {
        return intval($this->createQueryBuilder('e')
            ->Select('COUNT(e) ')->groupBy('e.nomexamen')
            ->getQuery()->getArrayResult());
    }
*/
    public function countexamsincategorie()
    {
        $dql = 'SELECT count(e) FROM App\Entity\Examen e Group BY e.categorie ';
        $query = $this->getEntityManager()->createQuery($dql);
        return ($query->execute());
    }


    public function examsbyCategorie(CategorieRepository $categorieRepository)
    {
        $sommeexams = $this->countexams();
        $listeCategorie = $this->countexamsincategorie() ;


        foreach($listeCategorie  as $count)
        {
           // $count /= $sommeexams ;

        }










        return $listeCategorie ;




    }




//    /**
//     * @return Examen[] Returns an array of Examen objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Examen
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function get()
    {
        $qb = $this->createQueryBuilder('e')
            ->join('e.categorie','c')
            ->join('e.formation','f');
        return $qb->getQuery()->getResult();
    }




}
