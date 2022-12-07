<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\Tutorshipsessions;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\TutorshipSessionRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\ChatSessionsRepository;
use App\Repository\MessagesRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Form\TutorshipsessionsType;
use App\Entity\Requests;
use App\Form\RequestsType;
use App\Repository\RequestsRepository;
use App\Service\GoogleCalendar;
use App\Repository\TokenRepository;
use App\Entity\Token;
use Symfony\Component\HttpFoundation\RedirectResponse;



class FrontOfficeController extends AbstractController
{

    private GoogleCalendar $googleServices;
    private TokenRepository $em;

    public function __construct(GoogleCalendar $googleServices, TokenRepository $em)
    {
        $this->googleServices = $googleServices;
        $this->em = $em;
    }
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepo, LoggerInterface $logger, EvenementRepository $evenementRepository): Response
    {
        
        $posts = $postRepo->findAll();
        return $this->render('front_office/index.html.twig', [
            'posts' => $posts,
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    #[Route('/comment/post', name: 'comment.app')]
    public function postComment(Request $request, CommentRepository $commentRepository, PostRepository $postRepository): Response
    {
        $comment = new Comment();
        $post = $postRepository->findOneBy(["postid"=>$request->request->get('postid')]);
        $post->setPostnbcom($post->getPostnbcom()+1);
        $user = $this->getUser();
        $comment->setCommentdate (new \DateTime()) ;
        $comment->setUser($user);
        $comment->setCommentcontent($request->request->get('content'));
        $comment->setPost($post);
            $commentRepository->save($comment, true);
            $postRepository->save($post,true);

            return $this->redirectToRoute('app_category_frontlist', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/sessions', name: 'app.sessions')]
    public function sessions(TutorshipSessionRepository $repo): Response
    {
        $user = $this->getUser();
        if (!$user){

            return $this->redirect('/');
        }
        $sessions = array_merge($repo->findBy(["idTutor" => $this->getUser()]), $repo->findBy(["idStudent" => $this->getUser()]));
        return $this->renderForm('front_office/sessions.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/api/form/', name: 'app.form', methods: ['GET'])]
    public function form(Request $request, TutorshipSessionRepository $repo): Response
    {
        
        $id = json_decode($request->get('info'));
        
        $tutorshipsession = $repo->find($id);
        $form = $this->createForm(TutorshipsessionsType::class, $tutorshipsession);
        
        return $this->renderForm('front_office/sessionForm.html.twig', [
            'session' => $tutorshipsession,
            'form'=>$form
        ]);
    }

    #[Route('/api/formPost/', name: 'app.form.post', methods: ['GET'])]
    public function formPost(Request $request, TutorshipSessionRepository $repo): Response
    {
        
        $session = $request->get('tutSession');
        $tutorshipsession = $repo->find($session['id']);
        $tutorshipsession->setBody($session['body']);
        $tutorshipsession->setType($session['type']);
        $date =  new \DateTime('@'.strtotime($session['date']));
        $tutorshipsession->setDate($date);
        $repo->save($tutorshipsession,true);
        // $tutorshipsession = $repo->find($id);
        // $form = $this->createForm(TutorshipsessionsType::class, $tutorshipsession);
        return $this->json("success");
        // return $this->renderForm('front_office/sessionForm.html.twig', [
        //     'session' => $tutorshipsession,
        //     'form'=>$form
        // ]);
    }

    #[Route('/messages', name: 'app.session', methods: ['GET'])]
    public function showInteface(Request $request,  LoggerInterface $logger, MessagesRepository $messagesRepository, TutorshipSessionRepository $repo, SerializerInterface $serializer)
    {

        $user = $this->getUser();
        if (!$user){

            return $this->redirect('/');
        }
        $sessions = $repo->getSessions($this->getUser());
        //dd($request);
        $refresh = 0;
        if (is_null($request->get('idSession'))) {
            if ($this->getUser()) {
                $lastSession = $repo->findLatestChat($this->getUser());
            } else {
                $lastSession = $repo->find(0);
            }
            if(is_null($lastSession)){
                $messages = $messagesRepository->findAll();
            }else{
                $messages = $messagesRepository->findBy(["idsession" => $lastSession->getIdsession()]);
            }
            
        } else {
            $lastSession = $repo->find($request->get('idSession'));
            $messages = $messagesRepository->findBy(["idsession" => $request->get('idSession'),"type"=>"MessagesChat"]);
        }
        
        return  $this->renderForm('front_office/session.html.twig', [
            'messages' => $messages,
            'currentSession' => "lastSession",
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

    #[Route('/newRequest', name: 'app_requests_new_front', methods: ['GET', 'POST'])]
    #[Route('/{id}/editRequest', name: 'app_requests_edit_front', methods: ['GET', 'POST'])]
    public function new(Request $request, RequestsRepository $requestsRepository): Response
    {
        if (is_null($request->get("id"))){
            $trequest = new Requests();
        }else {
            $trequest = $requestsRepository->find($request->get("id"));
        }
        
        $user = $this->getUser();
        $trequest->setIdstudent($user);
        $form = $this->createForm(RequestsType::class, $trequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $requestsRepository->save($trequest, true);
            $this->addFlash('success', 'Your request has been submitted successfully!');
            return $this->redirectToRoute('app_requests_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front_office/newRequest.html.twig', [
            'request' => $trequest,
            'form' => $form,
        ]);
    }

    #[Route('/indexRequests', name: 'app_requests_index_front', methods: ['GET'])]
    public function indexRequests(RequestsRepository $requestsRepository, Request $request): Response
    {
        $loginForm = $this->createFormBuilder()
            ->getForm();
        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted()) {
            $client = $this->googleServices->getClient();

            return $this->redirect($client->createAuthUrl());
        }

        return $this->renderForm('front_office/indexRequests.html.twig', [
            'requests' => $requestsRepository->findAll(),
            'loginForm' => $loginForm,
        ]);
    }

    #[Route('/front/{id}', name: 'app_requests_delete_front', methods: ['POST'])]
    public function delete(Request $request, Requests $trequest, RequestsRepository $requestsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trequest->getId(), $request->request->get('_token'))) {
            $requestsRepository->remove($trequest, true);
        }

        return $this->redirectToRoute('app_requests_index_front', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/approve/{id}', name: 'app_requests_approve_front')]
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
        return $this->redirectToRoute('app.sessions', [], Response::HTTP_SEE_OTHER);
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
        return $this->redirectToRoute('app_tutorshipsessions_index_front', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/callback', name: 'callback')]
    public function handleGoogle(Request $request): RedirectResponse
    {

        $code = $request->query->get('code');
        $token = $this->googleServices->getClient()->fetchAccessTokenWithAuthCode($code);

        $newToken = (new Token())->setToken($token['access_token']);
        $this->em->save($newToken, true);
        $this->addFlash('success', 'Connected! you can approve the request now');
        return $this->redirectToRoute('app_requests_index_front', [], Response::HTTP_SEE_OTHER);
    }
}
