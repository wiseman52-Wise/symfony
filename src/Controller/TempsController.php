<?php

namespace App\Controller;

use App\Entity\Emplois;
use App\Form\Emplois1Form;
use App\Repository\EmploisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/temps')]
final class TempsController extends AbstractController
{
    #[Route(name: 'app_temps_index', methods: ['GET'])]
    public function index(EmploisRepository $emploisRepository): Response
    {
        return $this->render('temps/index.html.twig', [
            'emplois' => $emploisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_temps_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emploi = new Emplois();
        $form = $this->createForm(Emplois1Form::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emploi);
            $entityManager->flush();

            return $this->redirectToRoute('app_temps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temps/new.html.twig', [
            'emploi' => $emploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_temps_show', methods: ['GET'])]
    public function show(Emplois $emploi): Response
    {
        return $this->render('temps/show.html.twig', [
            'emploi' => $emploi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_temps_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emplois $emploi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Emplois1Form::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_temps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temps/edit.html.twig', [
            'emploi' => $emploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_temps_delete', methods: ['POST'])]
    public function delete(Request $request, Emplois $emploi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($emploi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_temps_index', [], Response::HTTP_SEE_OTHER);
    }
}
