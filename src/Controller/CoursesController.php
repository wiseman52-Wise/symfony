<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\Cours1Form;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/courses')]
final class CoursesController extends AbstractController
{
    #[Route(name: 'app_courses_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('courses/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_courses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cour = new Cours();
        $form = $this->createForm(Cours1Form::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('courses/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_courses_show', methods: ['GET'])]
    public function show(Cours $cour): Response
    {
        return $this->render('courses/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_courses_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Cours1Form::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('courses/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_courses_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
    }
}
