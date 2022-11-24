<?php

namespace App\Controller;

use Amp\Http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\TutorshipSessionRepository;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;

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
        
        return $this->render('front_office/sessions.html.twig',[
            'sessions' => $repo->findAll()
        ]);
    }
}
