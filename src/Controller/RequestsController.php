<?php

namespace App\Controller;

use App\Entity\Chatsessions;
use App\Entity\Requests;
use App\Form\RequestsType;
use App\Repository\RequestsRepository;
use App\Entity\Tutorshipsessions;
use App\Repository\TutorshipSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GoogleCalendar;
use App\Entity\Token;
use App\Repository\ChatSessionsRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\TokenRepository;



#[Route('dashboard/requests')]
class RequestsController extends AbstractController
{
    private GoogleCalendar $googleServices;
    private TokenRepository $em;

    public function __construct(GoogleCalendar $googleServices, TokenRepository $em)
    {
        $this->googleServices = $googleServices;
        $this->em = $em;
    }
    #[Route('/', name: 'app_requests_index', methods: ['GET'])]
    public function index(RequestsRepository $requestsRepository, Request $request): Response
    {
        $loginForm = $this->createFormBuilder()
            ->getForm();
        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted()) {
            $client = $this->googleServices->getClient();

            return $this->redirect($client->createAuthUrl());
        }

        return $this->renderForm('back_office/requests/index.html.twig', [
            'requests' => $requestsRepository->findAll(),
            'loginForm' => $loginForm,
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
            $this->addFlash('success', 'Your request has been submitted successfully!');
            return $this->redirectToRoute('app_requests_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/requests/new.html.twig', [
            'request' => $trequest,
            'form' => $form,
        ]);
    }

    #[Route('/approve/{id}', name: 'app_requests_approve')]
    public function approve(Request $request, Requests $trequest, TutorshipSessionRepository $tutorshipSessionRepository, ChatSessionsRepository $chatrepo, RequestsRepository $requestsRepository)
    {
        $tutorshipsession = new Tutorshipsessions();
        $tutorshipsession->setIdRequest($trequest);
        $tutorshipsession->setIdStudent($trequest->getIdStudent());
        $tutorshipsession->setIdTutor($trequest->getIdTutor());
        $tutorshipsession->setDate($trequest->getDate());
        $tutorshipsession->setType($trequest->getType());
        $tutorshipsession->setBody($trequest->getBody());
        $tutorshipsession->setUrl("none");
        $tutorshipSessionRepository->save($tutorshipsession, false);
        
        $this->generateLink($tutorshipsession, $tutorshipSessionRepository, $trequest, $requestsRepository);
        $this->addFlash('success', 'The request has been approved!');
        return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
    }

    public function generateLink(TutorshipSessions $tutorshipsession, TutorshipSessionRepository $tutorshipSessionRepository, Requests $trequest, RequestsRepository $requestsRepository)
    {
        $allToken = $this->em->findAll();
        /** @var Token $token */
        $token = end($allToken);

        if (!$token) {
            $client = $this->googleServices->getClient();
            return $this->redirect($client->createAuthUrl());
        }
        $tutorshipSessionRepository->save($tutorshipsession, true);
        $url = $this->googleServices->addEvent($tutorshipsession);
        $tutorshipsession->setUrl($url);
        $tutorshipSessionRepository->save($tutorshipsession, true);
        $requestsRepository->remove($trequest, true);
        $this->addFlash('success', 'The request has been approved!');
        return $this->redirectToRoute('app_tutorshipsessions_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/callback', name: 'callback')]
    public function handleGoogle(Request $request): RedirectResponse
    {

        $code = $request->query->get('code');
        $token = $this->googleServices->getClient()->fetchAccessTokenWithAuthCode($code);

        $newToken = (new Token())->setToken($token['access_token']);
        $this->em->save($newToken, true);
        $this->addFlash('success', 'Connected! you can approve the request now');
        return $this->redirectToRoute('app_requests_index', [], Response::HTTP_SEE_OTHER);
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
}
