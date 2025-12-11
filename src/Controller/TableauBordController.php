<?php

namespace App\Controller;

use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TableauBordController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(SeanceRepository $repo): Response
    {
        $user = $this->getUser();

        // Total séances
        $totalSeances = $repo->count(['user' => $user]);

        // Total durée
        $total_seconds = $repo->getTotalDureeByUser($user->getId());
        $totalHeures = round($total_seconds / 3600, 1);



        // Dernière séance
        $lastSeance = $repo->findOneBy(
            ['user' => $user],
            ['date_entrainement' => 'DESC']
        );

        // 5 dernières séances
        $last5 = $repo->findBy(
            ['user' => $user],
            ['date_entrainement' => 'DESC'],
            5
        );

        // ============================
        //  GRAPH 1 : Types de séances
        // ============================

        $typesCount = $repo->countTypesByUser($user);

        $typesLabels = array_keys($typesCount);
        $typesValues = array_values($typesCount);

        // ============================
        //  GRAPH 2 : Volume hebdomadaire
        // ============================

        $weeklyVolume = $repo->getWeeklyVolumeByUser($user);

        $weeklyLabels = array_keys($weeklyVolume);  // ["Semaine 44", "Semaine 45", ...]
        $weeklyValues = array_values($weeklyVolume);

        return $this->render('tableau_bord/index.html.twig', [
            'total_seances' => $totalSeances,
            'total_heures' => $totalHeures,
            'last_seance' => $lastSeance,
            'last_5' => $last5,

            'types_seances_labels' => $typesLabels,
            'types_seances_values' => $typesValues,

            'weekly_volume_labels' => $weeklyLabels,
            'weekly_volume_values' => $weeklyValues,
        ]);

    }
}
