<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Vote;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\VoteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoteController extends AbstractController
{
    private $postrepo ;

    public function __construct(PostRepository $postrepo){
        $this->postrepo = $postrepo;
    }
    #[Route('/vote', name: 'app_vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'controller_name' => 'VoteController',
        ]);
    }

    #[Route('/{postid}/like' ,name: 'app_post_like')]
    public function like(Post $post, VoteRepository $voteRepository, PostRepository $postRepository)
    {

        $vote= new Vote();
        $userid = $this->getUser()->getId();

        $postid=$post->getPostid();
        $postvote=$post->getPostvote();
        if(($voteRepository->isliked($userid,$postid))===1)
        { $this->addFlash('info', 'already liked');}


        if((($voteRepository->isliked($userid,$postid))===0)&&(($voteRepository->isdisliked($userid,$postid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(1);
            $vote->setPostid($postid);
            $voteRepository->save($vote, true);
            $postvotefinal=$postvote+1;
            $postRepository->adjustlike($postid,$postvotefinal);
        }


        if(($voteRepository->isdisliked($userid,$postid))===1)
        {

            $voteRepository->changetolike($userid,$postid);
            $postvotefinal=$postvote+2;
            $postRepository->adjustlike($postid,$postvotefinal);

            $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');

        }
        return $this->render('back_office/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);


    }
    #[Route('/{postid}/dislike', name: 'app_post_dislike')]

    public function dislike(Post $post, VoteRepository $voteRepository, PostRepository $postRepository)
    {

        $vote= new Vote();
        $userid = $this->getUser()->getId();

        $postid=$post->getPostid();
        $postvote=$post->getPostvote();

        if(($voteRepository->isdisliked($userid,$postid))===1)
        { $this->addFlash('info', 'already disliked');}




        if((($voteRepository->isliked($userid,$postid))===0)&&(($voteRepository->isdisliked($userid,$postid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(-1);
            $vote->setPostid($postid);
            $voteRepository->save($vote, true);
            $postvotefinal=$postvote-1;
            $postRepository->adjustlike($postid,$postvotefinal);
        }



        if(($voteRepository->isliked($userid,$postid))===1)
        {
            $voteRepository->changetodislike($userid,$postid);
            $postvotefinal=$postvote-2;
            $postRepository->adjustlike($postid,$postvotefinal);

            $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');
        }


        return $this->render('back_office/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);


    }




/*
    #[Route('/front/{postid}/like' ,name: 'app_post_like_front')]
    public function likefront(Post $post, VoteRepository $voteRepository, PostRepository $postRepository,Category $category)
    {

        $vote= new Vote();
        $userid = $this->getUser()->getId();

        $postid=$post->getPostid();
        $postvote=$post->getPostvote();

        if(($voteRepository->isliked($userid,$postid))===1)
        { $this->addFlash('info', 'already liked');

        }


        if((($voteRepository->isliked($userid,$postid))===0)&&(($voteRepository->isdisliked($userid,$postid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(1);
            $vote->setPostid($postid);
            $voteRepository->save($vote, true);
            $postvotefinal=$postvote+1;
            $postRepository->adjustlike($postid,$postvotefinal);


        }


        if(($voteRepository->isdisliked($userid,$postid))===1)
        {

            $voteRepository->changetolike($userid,$postid);
            $postvotefinal=$postvote+2;
            $postRepository->adjustlike($postid,$postvotefinal);

           $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');

        }

        $posts = $this->postrepo->findBy(["category" => $category->getCategoryid()]);
        return $this->render('front_office/category/show.html.twig', [
            'category' => $category,
            'posts' => $posts
        ]);
    }


*/

}
