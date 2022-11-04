<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Form\ExamenType;
use App\Repository\ExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/examen')]
class ExamenController extends AbstractController
{
    #[Route('/', name: 'app_examen_index', methods: ['GET'])]
    public function index(ExamenRepository $examenRepository): Response
    {
        return $this->render('examen/index.html.twig', [
            'examens' => $examenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_examen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExamenRepository $examenRepository): Response
    {
        $examan = new Examen();
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenRepository->save($examan, true);

            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('examen/new.html.twig', [
            'examan' => $examan,
            'form' => $form,
        ]);
    }

    #[Route('/{idexamen}', name: 'app_examen_show', methods: ['GET'])]
    public function show(Examen $examan): Response
    {
        return $this->render('examen/show.html.twig', [
            'examan' => $examan,
        ]);
    }

    #[Route('/{idexamen}/edit', name: 'app_examen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Examen $examan, ExamenRepository $examenRepository): Response
    {
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenRepository->save($examan, true);

            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('examen/edit.html.twig', [
            'examan' => $examan,
            'form' => $form,
        ]);
    }

    #[Route('/{idexamen}', name: 'app_examen_delete', methods: ['POST'])]
    public function delete(Request $request, Examen $examan, ExamenRepository $examenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examan->getIdexamen(), $request->request->get('_token'))) {
            $examenRepository->remove($examan, true);
        }

        return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
    }
}
