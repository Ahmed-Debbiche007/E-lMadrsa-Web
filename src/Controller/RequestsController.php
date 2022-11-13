<?php

namespace App\Controller;

use App\Entity\Requests;
use App\Form\RequestsType;
use App\Repository\RequestsRepository;
use App\Entity\Tutorshipsessions;
use App\Repository\TutorshipSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\equalTo;

#[Route('dashboard/requests')]
class RequestsController extends AbstractController
{
    #[Route('/', name: 'app_requests_index', methods: ['GET'])]
    public function index(RequestsRepository $requestsRepository): Response
    {
        return $this->render('back_office/requests/index.html.twig', [
            'requests' => $requestsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_requests_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RequestsRepository $requestsRepository): Response
    {
        $trequest = new Requests();
        $user = $this->getUser();
        $trequest->setIdstudent($user);
        $form = $this->createForm(RequestsType::class, $trequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $requestsRepository->save($trequest, true);

            return $this->redirectToRoute('app_requests_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/requests/new.html.twig', [
            'request' => $trequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_requests_show', methods: ['GET'])]
    public function show(Requests $request): Response
    {
        
        return $this->render('back_office/requests/show.html.twig', [
            'request' => $request,
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_requests_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Requests $trequest, RequestsRepository $requestsRepository): Response
    {
        $form = $this->createForm(RequestsType::class, $trequest);
        $form->handleRequest($request);
        // $form->getWidget('idStudent')->setAttribute('onchange', 'refreshPage(this.form.services)');
         
        if ($form->isSubmitted() && $form->isValid()) {
         
            $requestsRepository->save($trequest, true);

            return $this->redirectToRoute('app_requests_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/requests/edit.html.twig', [
            'request' => $trequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_requests_delete', methods: ['POST'])]
    public function delete(Request $request, Requests $trequest, RequestsRepository $requestsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trequest->getId(), $request->request->get('_token'))) {
            $requestsRepository->remove($trequest, true);
        }

        return $this->redirectToRoute('app_requests_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/approve/{id}', name: 'app_requests_approve')]
    public function approve(Request $request, Requests $trequest, TutorshipSessionRepository $tutorshipSessionRepository)
    {
        $tutorshipsession = new Tutorshipsessions();
        $tutorshipsession->setIdRequest($trequest);
        $tutorshipsession->setIdStudent($trequest->getIdStudent());
        $tutorshipsession->setIdTutor($trequest->getIdTutor());
        $tutorshipsession->setDate($trequest->getDate());
        $tutorshipsession->setType($trequest->getType());    
        $tutorshipsession->setBody($trequest->getBody());
        if(strcmp($trequest->getType(), "MessagesChat") == 0){
            $tutorshipsession->setUrl("none");
        }elseif(strcmp($trequest->getType(), "VideoChat") == 0){
            $tutorshipsession->setUrl("googleMeet");
        }
        $tutorshipSessionRepository->save($tutorshipsession, true);
        
        return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
