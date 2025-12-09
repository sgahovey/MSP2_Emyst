<?php

namespace App\Controller;

use App\Repository\SeanceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TableauBordController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(SeanceRepository $repo): Response
    {
        $seances = $repo->findAll();

        // Total séances
        $total_seances = count($seances);

        // Total durée en heures
        $total_duree = 0;
        foreach ($seances as $s) {
            if ($s->getDuree()) {
                $total_duree += $s->getDuree()->getTimestamp();
            }
        }
        $total_heures = round($total_duree / 3600, 1);

        return $this->render('tableau_bord/index.html.twig', [
            'total_seances' => $total_seances,
            'total_heures' => $total_heures,
            'last_seance' => $seances ? end($seances) : null,
            'last_5' => array_slice(array_reverse($seances), 0, 5)
        ]);
    }

}
