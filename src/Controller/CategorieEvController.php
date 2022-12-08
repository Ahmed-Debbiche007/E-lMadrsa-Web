<?php

namespace App\Controller;

use App\Entity\CategorieEv;
use App\Form\CategorieEvType;
use App\Repository\CategorieEvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/categorieEv')]
class CategorieEvController extends AbstractController
{
    #[Route('/', name: 'app_categorie_ev_index', methods: ['GET'])]
    public function index(CategorieEvRepository $categorieEvRepository): Response
    {
        return $this->render('categorie_ev/index.html.twig', [
            'categorie_evs' => $categorieEvRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_ev_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieEvRepository $categorieEvRepository): Response
    {
        $categorieEv = new CategorieEv();
        $form = $this->createForm(CategorieEvType::class, $categorieEv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieEvRepository->save($categorieEv, true);

            return $this->redirectToRoute('app_categorie_ev_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_ev/new.html.twig', [
            'categorie_ev' => $categorieEv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_ev_show', methods: ['GET'])]
    public function show(CategorieEv $categorieEv): Response
    {
        return $this->render('categorie_ev/show.html.twig', [
            'categorie_ev' => $categorieEv,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_ev_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieEv $categorieEv, CategorieEvRepository $categorieEvRepository): Response
    {
        $form = $this->createForm(CategorieEvType::class, $categorieEv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieEvRepository->save($categorieEv, true);

            return $this->redirectToRoute('app_categorie_ev_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_ev/edit.html.twig', [
            'categorie_ev' => $categorieEv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_ev_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieEv $categorieEv, CategorieEvRepository $categorieEvRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieEv->getId(), $request->request->get('_token'))) {
            $categorieEvRepository->remove($categorieEv, true);
        }

        return $this->redirectToRoute('app_categorie_ev_index', [], Response::HTTP_SEE_OTHER);
    }
}
