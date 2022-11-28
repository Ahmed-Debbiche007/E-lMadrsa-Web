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
use Psr\Log\LoggerInterface;

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
            'sessions' => $sessions,
        ]);
    }

    #[Route('/api/messages/{idSession}', name: 'api_messages', methods: ['GET', 'POST'])]
    public function indexApi(Request $request, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo, SerializerInterface $serializer)
    {

        $sessions = $repo->getSessions($this->getUser());
        // foreach ($sessions as $session){
        //     dd($session->getMessages()->isEmpty());
        // }
        $message = new Messages();
        $message->setStatusdate(new \DateTime());

        return  $this->renderForm('front_office/components/chat.html.twig', [
            'messages' => $messagesRepository->findAll(),
            'sessions' => $sessions,
        ]);
    }

    #[Route('/api/post', name: 'api_messages_post', methods: ['POST'])]
    public function postApi(Request $request, LoggerInterface $logger, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo): Response
    {
        $postData = json_decode($request->getContent());
        $logger->info($postData);

        $message = new Messages();
        $user = $this->getUser();
        $message->setIdsender($user->getId());
        $message->setIdsession($repo->findLatest());
        $message->setBody($request->request->get('body'));
        $message->setStatusdate(new \DateTime());
        $messagesRepository->save($message, true);
        return $this->json('Created new project successfully');
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
        if ($this->isCsrfTokenValid('delete' . $message->getIdmessage(), $request->request->get('_token'))) {
            $messagesRepository->remove($message, true);
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}
