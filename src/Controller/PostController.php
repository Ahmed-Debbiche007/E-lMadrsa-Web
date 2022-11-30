<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Vote;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('dashboard/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository ): Response
    {
        return $this->render('back_office/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $post->setPostdate (new \DateTime()) ;
        $user = $this->getUser();
        $post->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/api/like', name: 'api_like_post', methods: ['POST'])]
    public function postApi(Request $request, VoteRepository $voteRepository, PostRepository $postRepository): Response
    {   $id=json_decode($request->getContent())->postid;
        $post=$postRepository->find($id);
        $vote= new Vote();
        $userid = $this->getUser()->getId();

        $postid=$post->getPostid();
        $postvote=$post->getPostvote();
        if(($voteRepository->isliked($userid,$postid))===1)
        { $this->addFlash('info', 'already liked');

            return $this->json("0");
        }


        if((($voteRepository->isliked($userid,$postid))===0)&&(($voteRepository->isdisliked($userid,$postid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(1);
            $vote->setPostid($postid);
            $voteRepository->save($vote, true);
            $postvotefinal=$postvote+1;
            $postRepository->adjustlike($postid,$postvotefinal);
            return $this->json("1");
        }


        if(($voteRepository->isdisliked($userid,$postid))===1)
        {

            $voteRepository->changetolike($userid,$postid);
            $postvotefinal=$postvote+2;
            $postRepository->adjustlike($postid,$postvotefinal);

            $this->addFlash('info', 'changed!!!!!!!!!!!!!!!!!!');
            return $this->json("2");
        }
        return $this->json("wilyey");
    }

    #[Route('/api/dislike', name: 'api_dislike_post', methods: ['POST'])]
    public function postApidislike(Request $request, VoteRepository $voteRepository, PostRepository $postRepository): Response
    {   $id=json_decode($request->getContent())->postid;
        $post=$postRepository->find($id);
        $vote= new Vote();
        $userid = $this->getUser()->getId();

        $postid=$post->getPostid();
        $postvote=$post->getPostvote();

        if(($voteRepository->isdisliked($userid,$postid))===1)
        { $this->addFlash('info', 'already disliked');
            return $this->json("0");}




        if((($voteRepository->isliked($userid,$postid))===0)&&(($voteRepository->isdisliked($userid,$postid))===0))
        { $vote->setUserid($userid);
            $vote->setVotenb(-1);
            $vote->setPostid($postid);
            $voteRepository->save($vote, true);
            $postvotefinal=$postvote-1;
            $postRepository->adjustlike($postid,$postvotefinal);
            return $this->json("-1");
        }



        if(($voteRepository->isliked($userid,$postid))===1)
        {
            $voteRepository->changetodislike($userid,$postid);
            $postvotefinal=$postvote-2;
            $postRepository->adjustlike($postid,$postvotefinal);


            return $this->json("-2");
        }
        return $this->json("wilyey");
    }



    #[Route('/newpostcat', name: 'app_post_new_cat', methods: ['GET', 'POST'])]
    public function newpostcat(Request $request, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $post->setPostdate (new \DateTime()) ;
        $user = $this->getUser();
        $post->setUser($user);
       // $post->setCategory($cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);
            $cat=$post->getCategory()->getCategoryid();

            return $this->redirectToRoute('app_category_showfront', ['categoryid' => $cat], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front_office/post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
//////////////////////////////////////////////////////////////////////////////////
    #[Route('/{postid}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post, CommentRepository $commentrepo): Response
    {
        return $this->render('back_office/post/show.html.twig', [
            'comments' => $commentrepo->findBy(["post"=>$post->getPostid()]),
            'post' => $post,
        ]);
    }
///////////////////////////////////////////////////////////////////////////////////
    #[Route('/front/{postid}', name: 'app_post_show_front', methods: ['GET'])]
    public function showpostfront(Post $post, CommentRepository $commentrepo): Response
    {
        return $this->render('front_office/post/show.html.twig', [
            'comments' => $commentrepo->findBy(["post"=>$post->getPostid()]),
            'post' => $post,
        ]);
    }





//////////////////////////////////////////////////////////////////////////////////
    #[Route('/{postid}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{postid}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getPostid(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }




}
