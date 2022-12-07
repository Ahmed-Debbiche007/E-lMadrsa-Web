<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;

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
}
