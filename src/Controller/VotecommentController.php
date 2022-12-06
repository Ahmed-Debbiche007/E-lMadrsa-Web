<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Votecomment;
use App\Repository\CommentRepository;
use App\Repository\VotecommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VotecommentController extends AbstractController
{
    #[Route('/votecomment', name: 'app_votecomment')]
    public function index(): Response
    {
        return $this->render('votecomment/index.html.twig', [
            'controller_name' => 'VotecommentController',
        ]);
    }





    #[Route('/comment/{commentid}/like' ,name: 'app_comment_like')]
    public function likecomment(Comment $comment, VotecommentRepository $voteRepository, CommentRepository $commentRepository)
    {

        $vote= new Votecomment();
        $userid = $this->getUser()->getId();

        $commentid=$comment->getcommentid();
        $commentvote=$comment->getcommentvote();
        if(($voteRepository->isliked($userid,$commentid))===1)
        { $this->addFlash('info', 'already liked');}


        if((($voteRepository->isliked($userid,$commentid))===0)&&(($voteRepository->isdisliked($userid,$commentid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(1);
            $vote->setcommentid($commentid);
            $voteRepository->save($vote, true);
            $commentvotefinal=$commentvote+1;
            $commentRepository->adjustlike($commentid,$commentvotefinal);
        }


        if(($voteRepository->isdisliked($userid,$commentid))===1)
        {

            $voteRepository->changetolike($userid,$commentid);
            $commentvotefinal=$commentvote+2;
            $commentRepository->adjustlike($commentid,$commentvotefinal);

            $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');

        }
        return $this->render('back_office/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);


    }
    #[Route('/comment/{commentid}/dislike', name: 'app_comment_dislike')]
    public function dislikecomment(Comment $comment, VotecommentRepository $voteRepository, CommentRepository $commentRepository)
    {

        $vote= new Votecomment();
        $userid = $this->getUser()->getId();

        $commentid=$comment->getcommentid();
        $commentvote=$comment->getcommentvote();

        if(($voteRepository->isdisliked($userid,$commentid))===1)
        { $this->addFlash('info', 'already disliked');}




        if((($voteRepository->isliked($userid,$commentid))===0)&&(($voteRepository->isdisliked($userid,$commentid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(-1);
            $vote->setcommentid($commentid);
            $voteRepository->save($vote, true);
            $commentvotefinal=$commentvote-1;
            $commentRepository->adjustlike($commentid,$commentvotefinal);
        }



        if(($voteRepository->isliked($userid,$commentid))===1)
        {
            $voteRepository->changetodislike($userid,$commentid);
            $commentvotefinal=$commentvote-2;
            $commentRepository->adjustlike($commentid,$commentvotefinal);

            $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');
        }


        return $this->render('back_office/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);


    }
}
