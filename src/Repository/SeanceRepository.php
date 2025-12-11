<?php

namespace App\Repository;

use App\Entity\Seance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seance>
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

    public function getTotalDureeByUser(int $userId): int
    {
        $seances = $this->createQueryBuilder('s')
            ->select('s.duree')
            ->where('s.user = :user')
            ->setParameter('user', $userId)
            ->getQuery()
            ->getResult();

        $totalSeconds = 0;

        foreach ($seances as $row) {
            /** @var \DateTimeImmutable $time */
            $time = $row['duree'];

            if ($time !== null) {
                $h = (int)$time->format('H');
                $m = (int)$time->format('i');
                $s = (int)$time->format('s');

                $totalSeconds += ($h * 3600) + ($m * 60) + $s;
            }
        }

        return $totalSeconds;
    }

    public function countTypesByUser($user): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s.type_seance AS type', 'COUNT(s.id) AS total')
            ->where('s.user = :user')
            ->setParameter('user', $user)
            ->groupBy('s.type_seance')
            ->getQuery()
            ->getResult();

        // On convertit en tableau simple : ["Full body" => 3, "Cardio" => 1, ...]
        $result = [];
        foreach ($qb as $row) {
            $result[$row['type']->value] = (int)$row['total'];
        }

        return $result;
    }

    public function getWeeklyVolumeByUser($user): array
    {
        // Récupérer toutes les séances du user
        $seances = $this->createQueryBuilder('s')
            ->where('s.user = :user')
            ->setParameter('user', $user)
            ->orderBy('s.date_entrainement', 'ASC')
            ->getQuery()
            ->getResult();

        $weeklyVolume = [];

        foreach ($seances as $seance) {
            /** @var \DateTimeImmutable $date */
            $date = $seance->getDateEntrainement();
            $week = (int) $date->format('W');      // Numéro de semaine
            $year = (int) $date->format('Y');      // Année (important pour éviter collisions)

            $key = "Semaine $week ($year)";

            // Convertir TIME en secondes manuellement
            $d = $seance->getDuree();
            $seconds = ((int)$d->format('H')) * 3600 +
                    ((int)$d->format('i')) * 60 +
                    ((int)$d->format('s'));

            if (!isset($weeklyVolume[$key])) {
                $weeklyVolume[$key] = 0;
            }

            $weeklyVolume[$key] += $seconds;
        }

        return $weeklyVolume;
    }


    //    /**
    //     * @return Seance[] Returns an array of Seance objects
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

    //    public function findOneBySomeField($value): ?Seance
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
