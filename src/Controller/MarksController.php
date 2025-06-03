<?php

namespace App\Controller;

use App\Entity\Notes;
use App\Form\Notes1Form;
use App\Repository\NotesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/marks')]
final class MarksController extends AbstractController
{
    #[Route(name: 'app_marks_index', methods: ['GET'])]
    public function index(NotesRepository $notesRepository): Response
    {
        return $this->render('marks/index.html.twig', [
            'notes' => $notesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_marks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $note = new Notes();
        $form = $this->createForm(Notes1Form::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('app_marks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('marks/new.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_marks_show', methods: ['GET'])]
    public function show(Notes $note): Response
    {
        return $this->render('marks/show.html.twig', [
            'note' => $note,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_marks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Notes $note, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Notes1Form::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_marks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('marks/edit.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_marks_delete', methods: ['POST'])]
    public function delete(Request $request, Notes $note, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($note);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_marks_index', [], Response::HTTP_SEE_OTHER);
    }
}
