<?php

namespace App\Controller;

use App\Entity\Prerequis;
use App\Form\PrerequisType;
use App\Repository\PrerequisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prerequis')]
class PrerequisController extends AbstractController
{
    #[Route('/', name: 'app_prerequis_index', methods: ['GET'])]
    public function index(PrerequisRepository $prerequisRepository): Response
    {
        return $this->render('prerequis/index.html.twig', [
            'prerequis' => $prerequisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_prerequis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrerequisRepository $prerequisRepository): Response
    {
        $prerequi = new Prerequis();
        $form = $this->createForm(PrerequisType::class, $prerequi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prerequisRepository->save($prerequi, true);

            return $this->redirectToRoute('app_prerequis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prerequis/new.html.twig', [
            'prerequi' => $prerequi,
            'form' => $form,
        ]);
    }

    #[Route('/{idprerequis}', name: 'app_prerequis_show', methods: ['GET'])]
    public function show(Prerequis $prerequi): Response
    {
        return $this->render('prerequis/show.html.twig', [
            'prerequi' => $prerequi,
        ]);
    }

    #[Route('/{idprerequis}/edit', name: 'app_prerequis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prerequis $prerequi, PrerequisRepository $prerequisRepository): Response
    {
        $form = $this->createForm(PrerequisType::class, $prerequi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prerequisRepository->save($prerequi, true);

            return $this->redirectToRoute('app_prerequis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prerequis/edit.html.twig', [
            'prerequi' => $prerequi,
            'form' => $form,
        ]);
    }

    #[Route('/{idprerequis}', name: 'app_prerequis_delete', methods: ['POST'])]
    public function delete(Request $request, Prerequis $prerequi, PrerequisRepository $prerequisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prerequi->getIdprerequis(), $request->request->get('_token'))) {
            $prerequisRepository->remove($prerequi, true);
        }

        return $this->redirectToRoute('app_prerequis_index', [], Response::HTTP_SEE_OTHER);
    }
}
