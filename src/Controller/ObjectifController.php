<?php

namespace App\Controller;

use App\Entity\Objectif;
use App\Form\ObjectifType;
use App\Repository\ObjectifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/objectif')]
final class ObjectifController extends AbstractController
{
    #[Route(name: 'app_objectif_index', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        ObjectifRepository $objectifRepository,
        EntityManagerInterface $em
    ): Response {

        $user = $this->getUser();

        // Verifier si on veut modifier un objectif
        $editId = $request->query->get('edit');
        if ($editId) {
            $objectif = $objectifRepository->findOneBy([
                'id' => $editId,
                'user' => $user
            ]);
        } else {
            $objectif = new Objectif();
        }

        // Formulaire partagé création/modif
        $form = $this->createForm(ObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // si création → ajouter le user
            if (!$objectif->getId()) {
                $objectif->setUser($user);
                $em->persist($objectif);
            }

            $em->flush();

            return $this->redirectToRoute('app_objectif_index');
        }

        return $this->render('objectif/index.html.twig', [
            'objectifs' => $objectifRepository->findBy(['user' => $user]),
            'form' => $form,
            'editMode' => $editId !== null,
        ]);
    }
}
