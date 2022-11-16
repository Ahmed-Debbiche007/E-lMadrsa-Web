<?php

namespace App\Controller;

use App\Entity\Tutorshipsessions;
use App\Form\TutorshipsessionsType;
use App\Repository\TutorshipSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/tutorshipSessions')]
class TutorshipsessionsController extends AbstractController
{
    #[Route('/', name: 'app_tutorshipsessions_index', methods: ['GET'])]
    public function index(TutorshipSessionRepository $tutorshipSessionRepository): Response
    {
        return $this->render('back_office/tutorshipsessions/index.html.twig', [
            'tutorshipsessions' => $tutorshipSessionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tutorshipsessions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TutorshipSessionRepository $tutorshipSessionRepository): Response
    {
        $tutorshipsession = new Tutorshipsessions();
        $form = $this->createForm(TutorshipsessionsType::class, $tutorshipsession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tutorshipSessionRepository->save($tutorshipsession, true);

            return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/tutorshipsessions/new.html.twig', [
            'tutorshipsession' => $tutorshipsession,
            'form' => $form,
        ]);
    }

    #[Route('/{idsession}', name: 'app_tutorshipsessions_show', methods: ['GET'])]
    public function show(Tutorshipsessions $tutorshipsession): Response
    {
        return $this->render('back_office/tutorshipsessions/show.html.twig', [
            'tutorshipsession' => $tutorshipsession,
        ]);
    }

    #[Route('/{idsession}/edit', name: 'app_tutorshipsessions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tutorshipsessions $tutorshipsession, TutorshipSessionRepository $tutorshipSessionRepository): Response
    {
        $form = $this->createForm(TutorshipsessionsType::class, $tutorshipsession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tutorshipSessionRepository->save($tutorshipsession, true);

            return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/tutorshipsessions/edit.html.twig', [
            'tutorshipsession' => $tutorshipsession,
            'form' => $form,
        ]);
    }

    #[Route('/{idsession}', name: 'app_tutorshipsessions_delete', methods: ['POST'])]
    public function delete(Request $request, Tutorshipsessions $tutorshipsession, TutorshipSessionRepository $tutorshipSessionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tutorshipsession->getIdsession(), $request->request->get('_token'))) {
            $tutorshipSessionRepository->remove($tutorshipsession, true);
        }

        return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
    }
}
