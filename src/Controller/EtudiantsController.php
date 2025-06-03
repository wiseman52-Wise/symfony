<?php

namespace App\Controller;

use App\Entity\Etudiants;
use App\Form\EtudiantsForm;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etudiants')]
final class EtudiantsController extends AbstractController
{
    #[Route(name: 'app_etudiants_index', methods: ['GET'])]
    public function index(EtudiantsRepository $etudiantsRepository): Response
    {
        return $this->render('etudiants/index.html.twig', [
            'etudiants' => $etudiantsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etudiants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etudiant = new Etudiants();
        $form = $this->createForm(EtudiantsForm::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etudiants/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etudiants_show', methods: ['GET'])]
    public function show(Etudiants $etudiant): Response
    {
        return $this->render('etudiants/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etudiants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etudiants $etudiant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtudiantsForm::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etudiants/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etudiants_delete', methods: ['POST'])]
    public function delete(Request $request, Etudiants $etudiant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
    }
}
