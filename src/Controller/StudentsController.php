<?php

namespace App\Controller;

use App\Entity\Etudiants;
use App\Form\Etudiants1Form;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/students')]
final class StudentsController extends AbstractController
{
    #[Route(name: 'app_students_index', methods: ['GET'])]
    public function index(EtudiantsRepository $etudiantsRepository): Response
    {
        return $this->render('students/index.html.twig', [
            'etudiants' => $etudiantsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_students_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etudiant = new Etudiants();
        $form = $this->createForm(Etudiants1Form::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('students/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_students_show', methods: ['GET'])]
    public function show(Etudiants $etudiant): Response
    {
        return $this->render('students/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_students_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etudiants $etudiant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Etudiants1Form::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('students/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_students_delete', methods: ['POST'])]
    public function delete(Request $request, Etudiants $etudiant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
    }
}
