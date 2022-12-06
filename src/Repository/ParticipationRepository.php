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

    /*$queryBuilder->select($queryBuilder->expr()->count('u.id'))
    ->from(User::class, 'u');

    $query = $queryBuilder->getQuery();*/
/*SELECT *,COUNT(participation.idFormation) as nbParticipation  FROM participation
JOIN formation ON participation.idFormation=formation.idFormation
GROUP BY sujet ORDER BY COUNT(participation.idFormation) DESC*/



   public function getFormByParticipation()  {


        $qb= $this->createQueryBuilder('p');
        $qb->select($qb->expr()->count('p.idformation'))
            ->addSelect('IDENTITY(p.formation)')
            ->groupBy('p.idformation')
            ->setMaxResults(1);
        print_r(intval($qb->getQuery()
            ->getScalarResult()));
        return  ($qb->getQuery()
            ->getResult());



    }
    public function getFormByParticipation1()  {


        $qb= $this->createQueryBuilder('p');
        $qb->select('p.idformation')
            ->groupBy('p.idformation')
            ->setMaxResults(1);
        print_r(intval($qb->getQuery()
            ->getScalarResult()));
        return  intval($qb->getQuery()
            ->getSingleScalarResult());



    }





    public function getFormByParticipation2()  {


        $qb= $this->createQueryBuilder('p');
        $qb->select('p.idformation')
            ->groupBy('p.idformation');


        return  ($qb->getQuery()
            ->getResult());


    }


    public function countParticipationForm()
    {
        $dql = 'SELECT count(p.idformation) from App\Entity\Participation p  Group BY p.idformation ';
        $query = $this->getEntityManager()->createQuery($dql);
        return ($query->execute());
    }


    public function ParticipationByForm(FormationRepository $formationRepository)
    {

        $nbParticipation = $this->countParticipationForm();





        /*public function getFormByParticipation()
        {
            $dql = 'SELECT count(e) FROM App\Entity\Participation e group by e.idformation order by DESC limit 1';
            $query = $this->getEntityManager()->createQuery($dql);
            return ($query->execute());
        }*/
        return $nbParticipation;

    }

    public function getSumresultatParFormation(){
        $dql = 'SELECT sum(p.resultat) from App\Entity\Participation p  Group BY p.idformation ';
        $query = $this->getEntityManager()->createQuery($dql);
        return ($query->execute());


    }
}
