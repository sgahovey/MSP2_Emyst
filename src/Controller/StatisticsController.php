<?php
// src/Controller/StatisticsController.php
namespace App\Controller;

use App\Repository\SeanceRepository;
use App\Repository\ExerciceRepository;
use App\Repository\SeanceExerciceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatisticsController extends AbstractController
{
    #[Route('/stats', name: 'app_stats')]
    public function index(
        Request $request,
        ExerciceRepository $exRepo,
        SeanceExerciceRepository $seExRepo,
        SeanceRepository $seanceRepo
    ): Response {
        $user = $this->getUser();

        // params
        $period = $request->query->get('period', 'month'); // week | month | year
        $exerciseId = $request->query->getInt('exercise', 0);

        // Liste des exercices (pour select)
        $exercises = $exRepo->findAll(); // ou filtrer par user si besoin

        // Si pas d'exerciseId, on prend le premier (s'il existe)
        if ($exerciseId === 0 && count($exercises) > 0) {
            $exerciseId = $exercises[0]->getId();
        }

        // Déterminer plage de dates et grouping
        $end = new \DateTimeImmutable('now');
        switch ($period) {
            case 'week':
                $start = $end->modify('-6 days'); // 7 jours (inclut today)
                $group = 'day';
                break;
            case 'year':
                $start = $end->modify('-11 months'); // 12 months
                $group = 'month';
                break;
            case 'month':
            default:
                $start = $end->modify('-29 days'); // 30 days
                $group = 'day';
                break;
        }

        // --- Progression par exercice (volume et durée) ---
        $seExRows = $seExRepo->findForUserAndExerciseBetweenDates($user, $exerciseId, $start, $end);

        // init labels according to grouping
        $labels = [];
        $periodKeys = []; // key => label mapping
        $cursor = $start;
        if ($group === 'day') {
            while ($cursor <= $end) {
                $k = $cursor->format('Y-m-d');
                $periodKeys[$k] = $cursor->format('d/m'); // label
                $cursor = $cursor->modify('+1 day');
            }
        } else { // month
            $cursor = new \DateTimeImmutable($start->format('Y-m-01'));
            $endMonth = new \DateTimeImmutable($end->format('Y-m-01'));
            while ($cursor <= $endMonth) {
                $k = $cursor->format('Y-m');
                $periodKeys[$k] = $cursor->format('M Y'); // label
                $cursor = $cursor->modify('+1 month');
            }
        }

        // initialize data arrays
        $volumeByKey = array_fill_keys(array_keys($periodKeys), 0.0); // total poids*reps
        $durationByKey = array_fill_keys(array_keys($periodKeys), 0); // seconds

        foreach ($seExRows as $seEx) {
            // $seEx is SeanceExercice
            $seance = $seEx->getSeances();
            if (!$seance) continue;
            $date = $seance->getDateEntrainement();
            if (!$date) continue;

            $key = ($group === 'day') ? $date->format('Y-m-d') : $date->format('Y-m');

            // volume: charge * repetitions
            $charge = $seEx->getCharge() ?? $seEx->getExercices()?->getCharge() ?? 0;
            $reps = $seEx->getRepetitions() ?? $seEx->getExercices()?->getRepetitions() ?? 0;
            $volumeByKey[$key] += ($charge * $reps);

            // durée (optionnelle) : priorité au seEx.duree sinon exercice.duree
            $d = $seEx->getDuree() ?? $seEx->getExercices()?->getDuree();
            if ($d !== null) {
                $seconds = ((int)$d->format('H'))*3600 + ((int)$d->format('i'))*60 + ((int)$d->format('s'));
                $durationByKey[$key] += $seconds;
            }
        }

        // Build arrays for Chart: labels, volume (numbers), duration (hours)
        $labels = array_values($periodKeys);
        $volumeValues = array_map(fn($k) => $volumeByKey[$k], array_keys($periodKeys));
        $durationValues = array_map(fn($k) => round($durationByKey[$k] / 3600, 2), array_keys($periodKeys)); // hours

        // --- Progression par semaine : total volume per week (use SeanceExercice rows across range) ---
        // For a broader period we may want last 12 weeks — choose last 12 weeks from end
        $weekStart = (clone $end)->modify('-11 weeks'); // last 12 weeks
        $seExAll = $seExRepo->findForUserBetweenDates($user, $weekStart, $end);

        $weekly = []; // key "YYYY-WW" => seconds or volume
        $weeklyVolume = []; // volume (poids*reps) per week

        // initialize last 12 week keys
        $cursor = (clone $weekStart);
        for ($i = 0; $i < 12; $i++) {
            $k = $cursor->format('o-\WW'); // iso year-week
            $weekly[$k] = 0;
            $weeklyVolume[$k] = 0;
            $cursor = $cursor->modify('+1 week');
        }

        foreach ($seExAll as $seEx) {
            $s = $seEx->getSeances();
            if (!$s) continue;
            $date = $s->getDateEntrainement();
            $k = $date->format('o-\WW');

            $charge = $seEx->getCharge() ?? $seEx->getExercices()?->getCharge() ?? 0;
            $reps = $seEx->getRepetitions() ?? $seEx->getExercices()?->getRepetitions() ?? 0;
            $weeklyVolume[$k] = ($weeklyVolume[$k] ?? 0) + ($charge * $reps);
        }

        $weeklyLabels = array_map(
            fn($k) => (new \DateTimeImmutable(substr($k, 0, 4).'-W'.substr($k, -2)))->format('d/m'), 
            array_keys($weeklyVolume)
        );
        $weeklyValues = array_values($weeklyVolume);

        return $this->render('stats/index.html.twig', [
            'exercises' => $exercises,
            'selected_exercise' => $exerciseId,
            'period' => $period,

            'labels_exercise' => $labels,
            'volume_exercise' => $volumeValues,
            'duration_exercise' => $durationValues,

            'weekly_labels' => $weeklyLabels,
            'weekly_values' => $weeklyValues,
        ]);
    }
}
