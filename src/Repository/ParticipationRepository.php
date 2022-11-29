<?php

namespace App\Repository;

use App\Entity\Participation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Participation>
 *
 * @method Participation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participation[]    findAll()
 * @method Participation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participation::class);
    }

    public function save(Participation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Participation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Participation[] Returns an array of Participation objects
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

//    public function findOneBySomeField($value): ?Participation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
//SELECT  u.nom FROM participation p join user u   order by p.resultat DESC  limit 3 ;
//$qry = $this->manager()->createQueryBuilder()
//        ->select(array('e', 's', 'a'))
//        ->from($this->entity, 'e')
//        ->leftJoin('e.sources', 's')
//        ->leftJoin('s.node', 'a');


    public function topstudentsresults($val): array
    {
        return $this->createQueryBuilder('e')
            ->join('e.user','u')
            ->join('e.formation','f')
            ->join('f.examen','ex')
            ->select('u.nom')
            ->orderBy('e.resultat', 'ASC')
            ->where('ex=:val')
            ->setParameter('val',$val)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

/*
    public function PartByMonths(): array
    {
        return $this->createQueryBuilder('p')
            ->addSelect('SUM(CASE Month(p.datePart) WHEN 1 THEN 1 ELSE 0 END) AS February')
            ->where('p.date_part BETWEEN :date1 AND :date2')
            ->setParameter('date1','2022/01/01')-
            ->setParameter('date2','2022/12/12')
            ->getQuery()
            ->getResult()
            ;
    }
*/
/*
    public function PartByMonths()
    {
        $dql = 'SELECT SUM(CASE Month(p.datePart) WHEN 1 THEN 1 ELSE 0 END) AS February FROM App\Entity\Participation p WHERE p.datePart BETWEEN 2022/01/01 AND 2022/12/12  ';
        $query = $this->getEntityManager()->createQuery($dql);
        return ($query->execute());
    }
*/
}
