<?php

namespace App\Repository;

use App\Entity\SeanceExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SeanceExercice>
 */
class SeanceExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeanceExercice::class);
    }

    public function findForUserBetweenDates($user, \DateTimeInterface $start, \DateTimeInterface $end): array
    {
        // retourne les SeanceExercice liés aux séances du user entre les dates
        $qb = $this->createQueryBuilder('se')
            ->innerJoin('se.seances', 's')
            ->addSelect('s')
            ->where('s.user = :user')
            ->andWhere('s.date_entrainement BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('s.date_entrainement', 'ASC')
            ->getQuery();

        return $qb->getResult();
    }

    public function findForUserAndExerciseBetweenDates($user, int $exerciseId, \DateTimeInterface $start, \DateTimeInterface $end): array
    {
        $qb = $this->createQueryBuilder('se')
            ->innerJoin('se.seances', 's')
            ->addSelect('s')
            ->innerJoin('se.exercices', 'e')
            ->addSelect('e')
            ->where('s.user = :user')
            ->andWhere('e.id = :exId')
            ->andWhere('s.date_entrainement BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('exId', $exerciseId)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('s.date_entrainement', 'ASC')
            ->getQuery();

        return $qb->getResult();
    }


    //    /**
    //     * @return SeanceExercice[] Returns an array of SeanceExercice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SeanceExercice
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
