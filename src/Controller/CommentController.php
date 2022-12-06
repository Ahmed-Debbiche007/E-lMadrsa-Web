<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Votecomment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\VotecommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('dashboard/comment')]
class CommentController extends AbstractController
{
    #[Route('/', name: 'app_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('back_office/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $user = $this->getUser();
        $comment->setCommentdate (new \DateTime()) ;
        $comment->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->save($comment, true);

            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }
    #[Route('/front/new', name: 'app_comment_new_front', methods: ['GET', 'POST'])]
    public function newcommentfront(Request $request, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $user = $this->getUser();
        $comment->setCommentdate (new \DateTime()) ;
        $comment->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->save($comment, true);

            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front_office/comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }
    #[Route('/api/like', name: 'api_like_comment', methods: ['POST'])]
    public function postApi(Request $request, VotecommentRepository $voteRepository, CommentRepository $commentRepository): Response
    {   $id=json_decode($request->getContent())->commentid;

        $comment=$commentRepository->find($id);

        $vote= new Votecomment();
        $userid = $this->getUser()->getId();

        $commentid=$comment->getcommentid();
        $commentvote=$comment->getcommentvote();


        if(($voteRepository->isliked($userid,$commentid))===1)
        {  return $this->json("0");}


        if((($voteRepository->isliked($userid,$commentid))===0)&&(($voteRepository->isdisliked($userid,$commentid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(1);
            $vote->setcommentid($commentid);
            $voteRepository->save($vote, true);
            $commentvotefinal=$commentvote+1;
            $commentRepository->adjustlike($commentid,$commentvotefinal);
            return $this->json("1");
        }


        if(($voteRepository->isdisliked($userid,$commentid))===1)
        {

            $voteRepository->changetolike($userid,$commentid);
            $commentvotefinal=$commentvote+2;
            $commentRepository->adjustlike($commentid,$commentvotefinal);

            return $this->json("2");

        }
        return $this->json("wilyey");
    }

    #[Route('/api/dislike', name: 'api_dislike_comment', methods: ['POST'])]
    public function commentApidislike(Request $request, VotecommentRepository $voteRepository, CommentRepository $commentRepository): Response
    {   $id=json_decode($request->getContent())->commentid;
        $comment=$commentRepository->find($id);
        $vote= new Votecomment();
        $userid = $this->getUser()->getId();

        $commentid=$comment->getcommentid();
        $commentvote=$comment->getcommentvote();


        if(($voteRepository->isdisliked($userid,$commentid))===1)
        { $this->addFlash('info', 'already disliked');
            return $this->json("0");

        }




        if((($voteRepository->isliked($userid,$commentid))===0)&&(($voteRepository->isdisliked($userid,$commentid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(-1);
            $vote->setcommentid($commentid);
            $voteRepository->save($vote, true);
            $commentvotefinal=$commentvote-1;
            $commentRepository->adjustlike($commentid,$commentvotefinal);
            return $this->json("-1");
        }




        if(($voteRepository->isliked($userid,$commentid))===1)
        {
            $voteRepository->changetodislike($userid,$commentid);
            $commentvotefinal=$commentvote-2;
            $commentRepository->adjustlike($commentid,$commentvotefinal);

            return $this->json("-2");
        }
        return $this->json("wilyey");
    }

    #[Route('/{commentid}', name: 'app_comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('back_office/comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{commentid}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->save($comment, true);

            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }

    #[Route('/{commentid}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getCommentid(), $request->request->get('_token'))) {
            $commentRepository->remove($comment, true);
        }

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }













}
