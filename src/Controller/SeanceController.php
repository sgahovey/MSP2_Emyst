<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Seance;
use App\Entity\SeanceExercice;
use App\Form\SeanceType;
use App\Repository\ExerciceRepository;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/seance')]
final class SeanceController extends AbstractController
{
    #[Route(name: 'app_seance_index', methods: ['GET'])]
    public function index(SeanceRepository $seanceRepository): Response
    {
        $seances = $seanceRepository->findAll();
        
        // Trier les séances : séance du jour, puis séances à venir, puis séances passées
        $now = new \DateTimeImmutable('now');
        $todayStart = $now->setTime(0, 0, 0);
        $todayEnd = $now->setTime(23, 59, 59);
        
        $seanceToday = null;
        $seancesFutures = [];
        $seancesPassees = [];
        
        foreach ($seances as $seance) {
            $dateSeance = $seance->getDateEntrainement();
            
            // Séance du jour
            if ($dateSeance >= $todayStart && $dateSeance <= $todayEnd) {
                $seanceToday = $seance;
            }
            // Séances à venir (après aujourd'hui)
            elseif ($dateSeance > $todayEnd) {
                $seancesFutures[] = $seance;
            }
            // Séances passées
            else {
                $seancesPassees[] = $seance;
            }
        }
        
        // Trier les séances futures par date croissante
        usort($seancesFutures, function($a, $b) {
            return $a->getDateEntrainement() <=> $b->getDateEntrainement();
        });
        
        // Trier les séances passées par date décroissante (plus récentes en premier)
        usort($seancesPassees, function($a, $b) {
            return $b->getDateEntrainement() <=> $a->getDateEntrainement();
        });
        
        // Si pas de séance du jour, prendre la plus proche (future ou passée)
        if ($seanceToday === null) {
            $toutesSeances = array_merge($seancesFutures, $seancesPassees);
            if (!empty($toutesSeances)) {
                usort($toutesSeances, function($a, $b) use ($now) {
                    $diffA = abs($a->getDateEntrainement()->getTimestamp() - $now->getTimestamp());
                    $diffB = abs($b->getDateEntrainement()->getTimestamp() - $now->getTimestamp());
                    return $diffA <=> $diffB;
                });
                $seanceToday = $toutesSeances[0];
                // Retirer de la liste appropriée
                if (in_array($seanceToday, $seancesFutures)) {
                    $seancesFutures = array_filter($seancesFutures, fn($s) => $s !== $seanceToday);
                    $seancesFutures = array_values($seancesFutures);
                } else {
                    $seancesPassees = array_filter($seancesPassees, fn($s) => $s !== $seanceToday);
                    $seancesPassees = array_values($seancesPassees);
                }
            }
        }
        
        // Assembler dans l'ordre : séance du jour, futures, passées
        $seancesTriees = [];
        if ($seanceToday !== null) {
            $seancesTriees[] = $seanceToday;
        }
        $seancesTriees = array_merge($seancesTriees, $seancesFutures, $seancesPassees);
        
        return $this->render('seance/index.html.twig', [
            'seances' => $seancesTriees,
            'seanceToday' => $seanceToday,
        ]);
    }

    #[Route('/new', name: 'app_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ExerciceRepository $exerciceRepository): Response
    {
        $seance = new Seance();
        $user = $this->getUser();
        $seance->setUser($user);
        
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seance);
            $entityManager->flush();

            // Traiter les exercices sélectionnés
            $exercicesData = $request->request->all('exercices');
            if (!empty($exercicesData)) {
                foreach ($exercicesData as $exerciceData) {
                    $exerciceId = $exerciceData['exercice_id'] ?? null;
                    if (!$exerciceId) {
                        continue;
                    }

                    $exercice = $exerciceRepository->find($exerciceId);
                    if (!$exercice) {
                        continue;
                    }

                    $seanceExercice = new SeanceExercice();
                    $seanceExercice->setSeances($seance);
                    $seanceExercice->setExercices($exercice);
                    $seanceExercice->setOrdre($exerciceData['ordre'] ?? 1);
                    $seanceExercice->setRepetitions((int)($exerciceData['repetitions'] ?? 0));
                    $seanceExercice->setCharge((int)($exerciceData['charge'] ?? 0));
                    
                    // Gérer la durée (format HH:MM:SS ou HH:MM)
                    if (!empty($exerciceData['duree'])) {
                        $dureeParts = explode(':', $exerciceData['duree']);
                        $hours = (int)($dureeParts[0] ?? 0);
                        $minutes = (int)($dureeParts[1] ?? 0);
                        $seconds = (int)($dureeParts[2] ?? 0);
                        $duree = new \DateTimeImmutable();
                        $duree = $duree->setTime($hours, $minutes, $seconds);
                        $seanceExercice->setDuree($duree);
                    } else {
                        // Durée par défaut 00:00:00
                        $duree = new \DateTimeImmutable();
                        $duree = $duree->setTime(0, 0, 0);
                        $seanceExercice->setDuree($duree);
                    }

                    $entityManager->persist($seanceExercice);
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        // Charger les exercices avec tri par nom
        $exercices = $exerciceRepository->createQueryBuilder('e')
            ->orderBy('e.nom', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form,
            'exercices' => $exercices,
        ]);
    }

    #[Route('/{id}', name: 'app_seance_show', methods: ['GET'])]
    public function show(Seance $seance): Response
    {
        return $this->render('seance/show.html.twig', [
            'seance' => $seance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seance $seance, EntityManagerInterface $entityManager, ExerciceRepository $exerciceRepository): Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Supprimer les anciens SeanceExercice
            foreach ($seance->getSeanceExercices() as $seanceExercice) {
                $entityManager->remove($seanceExercice);
            }
            $entityManager->flush();

            // Traiter les exercices sélectionnés
            $exercicesData = $request->request->all('exercices');
            if (!empty($exercicesData)) {
                foreach ($exercicesData as $exerciceData) {
                    $exerciceId = $exerciceData['exercice_id'] ?? null;
                    if (!$exerciceId) {
                        continue;
                    }

                    $exercice = $exerciceRepository->find($exerciceId);
                    if (!$exercice) {
                        continue;
                    }

                    $seanceExercice = new SeanceExercice();
                    $seanceExercice->setSeances($seance);
                    $seanceExercice->setExercices($exercice);
                    $seanceExercice->setOrdre($exerciceData['ordre'] ?? 1);
                    $seanceExercice->setRepetitions((int)($exerciceData['repetitions'] ?? 0));
                    $seanceExercice->setCharge((int)($exerciceData['charge'] ?? 0));
                    
                    // Gérer la durée (format HH:MM:SS ou HH:MM)
                    if (!empty($exerciceData['duree'])) {
                        $dureeParts = explode(':', $exerciceData['duree']);
                        $hours = (int)($dureeParts[0] ?? 0);
                        $minutes = (int)($dureeParts[1] ?? 0);
                        $seconds = (int)($dureeParts[2] ?? 0);
                        $duree = new \DateTimeImmutable();
                        $duree = $duree->setTime($hours, $minutes, $seconds);
                        $seanceExercice->setDuree($duree);
                    } else {
                        // Durée par défaut 00:00:00
                        $duree = new \DateTimeImmutable();
                        $duree = $duree->setTime(0, 0, 0);
                        $seanceExercice->setDuree($duree);
                    }

                    $entityManager->persist($seanceExercice);
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        // Charger les exercices avec tri par nom
        $exercices = $exerciceRepository->createQueryBuilder('e')
            ->orderBy('e.nom', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form,
            'exercices' => $exercices,
        ]);
    }

    #[Route('/{id}', name: 'app_seance_delete', methods: ['POST'])]
    public function delete(Request $request, Seance $seance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
