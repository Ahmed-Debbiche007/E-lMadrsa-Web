<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\TutorshipSessionRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\ChatSessionsRepository;
use App\Repository\MessagesRepository;
use Symfony\Component\Serializer\SerializerInterface;


class FrontOfficeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepo): Response
    {
        $posts = $postRepo->findAll();
        return $this->render('front_office/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/sessions', name: 'app.sessions')]
    public function sessions(TutorshipSessionRepository $repo): Response
    {
        $sessions = array_merge($repo->findBy(["idTutor" => $this->getUser()]), $repo->findBy(["idStudent" => $this->getUser()]));


        return $this->render('front_office/sessions.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/messages', name: 'app.session', methods: ['GET'])]
    public function showInteface(Request $request,  LoggerInterface $logger, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo, SerializerInterface $serializer)
    {
        $logger->critical($request->get('idSession'));
        $sessions = $repo->getSessions($this->getUser());
        if (is_null($request->get('idSession'))) {
            $lastSession = $repo->findLatest($this->getUser()->getId());
            $messages = $messagesRepository->findBy(["idsession" => $lastSession->getIdsession()]);
        } else {
            $lastSession= $repo->find($request->get('idSession'));
            $messages = $messagesRepository->findBy(["idsession" => $request->get('idSession')]);
        }
        // foreach ($sessions as $session){
        //     dd($session->getMessages()->isEmpty());
        // }
        $refresh = 0;

        return  $this->renderForm('front_office/session.html.twig', [
            'messages' => $messages,
            'currentSession'=>$lastSession,
            'sessions' => $sessions,
            'refresh' => $refresh,
            'id' => $request->get('idSession'),
        ]);
    }

    #[Route('/api/messages', name: 'app.messages', methods: ['GET'])]
    public function showMessages(Request $request,  LoggerInterface $logger, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo, SerializerInterface $serializer)
    {

        $sessions = $repo->getSessions($this->getUser());
   


        return  $this->renderForm('front_office/msg.html.twig', [
            'messages' => $messagesRepository->findBy(["idsession" => $request->get('idSession')]),
            'sessions' => $sessions,
            
            'id' => $request->get('idSession'),
        ]);
    }

    #[Route('/api/post', name: 'api_messages_post', methods: ['POST'])]
    public function postApi(Request $request, LoggerInterface $logger, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo): Response
    {
        $msg = json_decode($request->getContent());
        $logger->info($msg->idSession);

        $message = new Messages();
        $user = $this->getUser();
        $message->setIdsender($user->getId());
        $session = $repo->find($msg->idSession);
        $message->setIdsession($session);
        $message->setBody($msg->body);
        $message->setStatusdate(new \DateTime());
        $messagesRepository->save($message, true);
        return $this->json("success");
    }
}
