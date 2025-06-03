<?php

namespace App\Controller;

use App\Entity\Documents;
use App\Form\Documents1Form;
use App\Repository\DocumentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/docs')]
final class DocsController extends AbstractController
{
    #[Route(name: 'app_docs_index', methods: ['GET'])]
    public function index(DocumentsRepository $documentsRepository): Response
    {
        return $this->render('docs/index.html.twig', [
            'documents' => $documentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_docs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $document = new Documents();
        $form = $this->createForm(Documents1Form::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('app_docs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('docs/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_docs_show', methods: ['GET'])]
    public function show(Documents $document): Response
    {
        return $this->render('docs/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_docs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documents $document, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Documents1Form::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_docs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('docs/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_docs_delete', methods: ['POST'])]
    public function delete(Request $request, Documents $document, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_docs_index', [], Response::HTTP_SEE_OTHER);
    }
}
