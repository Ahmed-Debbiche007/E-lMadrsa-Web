<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\ChatSessionsRepository;
use App\Repository\MessagesRepository;
use App\Repository\TutorshipSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/messages')]
class MessagesController extends AbstractController
{
    #[Route('/', name: 'app_messages_index', methods: ['GET', 'POST'])]
    public function index(Request $request, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo): Response
    {
        $sessions = $repo->findAll();
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $message->setStatusdate(new \DateTime());
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $messagesRepository->save($message, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('back_office/messages/index.html.twig', [
            'messages' => $messagesRepository->findAll(),
            'form' => $form,
            'sessions' => $sessions ,
        ]);
    }

    #[Route('/api/messages', name: 'api_messages', methods: ['GET'])]
    public function indexApi(MessagesRepository $messagesRepository, TutorshipSessionRepository $repo, SerializerInterface $serializer)
    {
        $messages = $messagesRepository->findAll();
        $sessions = $repo->findAll();
        $json = $serializer->serialize($messages, 'json');
        return $this->json($json);
    }

    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessagesRepository $messagesRepository): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messagesRepository->save($message, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/messages/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{idmessage}', name: 'app_messages_show', methods: ['GET'])]
    public function show(Messages $message): Response
    {
        return $this->render('back_office/messages/show.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{idmessage}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messagesRepository->save($message, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/messages/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{idmessage}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getIdmessage(), $request->request->get('_token'))) {
            $messagesRepository->remove($message, true);
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }

   
}
