<?php

namespace App\Controller;

use App\Entity\Chatsessions;
use App\Form\ChatsessionsType;
use App\Repository\ChatSessionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chatsessions')]
class ChatsessionsController extends AbstractController
{
    #[Route('/', name: 'app_chatsessions_index', methods: ['GET'])]
    public function index(ChatSessionsRepository $chatSessionsRepository): Response
    {
        return $this->render('chatsessions/index.html.twig', [
            'chatsessions' => $chatSessionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chatsessions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChatSessionsRepository $chatSessionsRepository): Response
    {
        $chatsession = new Chatsessions();
        $form = $this->createForm(ChatsessionsType::class, $chatsession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chatSessionsRepository->save($chatsession, true);

            return $this->redirectToRoute('app_chatsessions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chatsessions/new.html.twig', [
            'chatsession' => $chatsession,
            'form' => $form,
        ]);
    }

    #[Route('/{idsession}', name: 'app_chatsessions_show', methods: ['GET'])]
    public function show(Chatsessions $chatsession): Response
    {
        return $this->render('chatsessions/show.html.twig', [
            'chatsession' => $chatsession,
        ]);
    }

    #[Route('/{idsession}/edit', name: 'app_chatsessions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chatsessions $chatsession, ChatSessionsRepository $chatSessionsRepository): Response
    {
        $form = $this->createForm(ChatsessionsType::class, $chatsession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chatSessionsRepository->save($chatsession, true);

            return $this->redirectToRoute('app_chatsessions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chatsessions/edit.html.twig', [
            'chatsession' => $chatsession,
            'form' => $form,
        ]);
    }

    #[Route('/{idsession}', name: 'app_chatsessions_delete', methods: ['POST'])]
    public function delete(Request $request, Chatsessions $chatsession, ChatSessionsRepository $chatSessionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chatsession->getIdsession(), $request->request->get('_token'))) {
            $chatSessionsRepository->remove($chatsession, true);
        }

        return $this->redirectToRoute('app_chatsessions_index', [], Response::HTTP_SEE_OTHER);
    }
}
