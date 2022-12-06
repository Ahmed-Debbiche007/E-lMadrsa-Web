<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Form\ExamenType;
use App\Repository\CategorieEvRepository;
use App\Repository\CategorieRepository;
use App\Repository\ExamenRepository;
use App\Repository\ParticipationRepository;
use App\Repository\QuestionRepository;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('dashboard/examen')]
class ExamenController extends AbstractController
{

    #[Route('/list', name: 'app_examen_listt')]
    public function listExams(ExamenRepository $examenRepository, CategorieRepository $categorieRepository)
    {

        return $this->render('front_office/exams/examens.html.twig', [
            'examens' => $examenRepository->findAll(),
            'categories'=>$categorieRepository->findAll(),
        ]);
    }


    #[Route('/top3', name: 'app_examen_top')]
    public function resultstop(ExamenRepository $examenRepository, CategorieRepository $categorieRepository)
    {

        return $this->render('back_office/examen/resultat.html.twig', [
            'examens' => $examenRepository->findAll(),
            'categories'=>$categorieRepository->findAll(),
        ]);
    }



    #[Route('/list/categorie/{id}', name: 'app_examen_listtbycategorie')]
    public function listExamsbyCategrie( ExamenRepository $examenRepository, CategorieRepository $categorieRepository , int $id)
    {
        return $this->render('front_office/exams/examens.html.twig', [
            'examens' => $examenRepository->findExamsByCategorieId($id),
            'categories'=>$categorieRepository->findAll(),
        ]);
    }


    #[Route('/list/examenbymanygategories', name: 'app_examen_examenbymanygategories')]
    public function examenbymanygategories( Request $request,  ExamenRepository $examenRepository, CategorieRepository $categorieRepository)
    {

     // $catid[] = [1,2,3];
        $catidd= (urldecode($request->getQueryString())) ;
        $catid = array_map('intval', explode(',', $catidd));
        // print_r($catid[1]) ;

     $arrayexams=$examenRepository->findExamsByCategorieId(3);
        for($i = 0, $size =  count($catid); $i < $size; ++$i) {
            $arrayexams =  array_merge($arrayexams , $examenRepository->findExamsByCategorieId(($catid[$i] ) ));
          }


        return $this->render('front_office/exams/examens.html.twig', [
            'examens' =>  $arrayexams,
            'categories'=>$categorieRepository->findAll(),
        ]);
    }




    #[Route('/pass/{id}', name: 'app_examen_pass')]
    public function passExam(int $id,QuestionRepository $qrepo,ExamenRepository $examenRepository, CategorieRepository $categorieRepository,ParticipationRepository $participationRepository)
    {
         return $this->render('front_office/exams/passExam.html.twig',['questions'=>$qrepo->findByExamsId($id),"topstudents"=>$participationRepository->topstudentsresults($id)]);
    }






    #[Route('/', name: 'app_examen_index', methods: ['GET'])]
    public function index(ExamenRepository $examenRepository): Response
    {
        return $this->render('back_office/examen/index.html.twig', [
            'examens' => $examenRepository->get(),
        ]);
    }

    #[Route('/new', name: 'app_examen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExamenRepository $examenRepository): Response
    {
        $examan = new Examen();
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenRepository->save($examan, true);

            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/examen/new.html.twig', [
            'examan' => $examan,
            'form' => $form,
        ]);
    }

    #[Route('/tutor/add', name: 'app_examen_new_tutor', methods: ['GET', 'POST'])]
    public function newexamfromtutor(Request $request, ExamenRepository $examenRepository): Response
    {
        $examan = new Examen();
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenRepository->save($examan, true);

            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front_office/exams/createExam.html.twig', [
            'examan' => $examan,
            'form' => $form,
        ]);
    }


    #[Route('/{idexamen}', name: 'app_examen_show', methods: ['GET'])]
    public function show(Examen $examan): Response
    {
        return $this->render('back_office/examen/show.html.twig', [
            'examan' => $examan,
        ]);
    }

    #[Route('showfront/{idexamen}', name: 'app_examen_show_front')]
    public function showfrontexam(ParticipationRepository $participationRepository,int $idexamen,ExamenRepository $repo,CategorieRepository $categorieRepository): Response
    {
        return $this->render('front_office/exams/show.html.twig', [
            'examen' => $repo->find($idexamen),
            'categories'=>$categorieRepository->findAll(),
            "topstudents"=>$participationRepository->topstudentsresults($idexamen)
        ]);
    }

    #[Route('/{idexamen}/edit', name: 'app_examen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Examen $examan, ExamenRepository $examenRepository): Response
    {
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenRepository->save($examan, true);

            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/examen/edit.html.twig', [
            'examan' => $examan,
            'form' => $form,
        ]);
    }

    #[Route('/{idexamen}', name: 'app_examen_delete', methods: ['POST'])]
    public function delete(Request $request, Examen $examan, ExamenRepository $examenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examan->getIdexamen(), $request->request->get('_token'))) {
            $examenRepository->remove($examan, true);
            return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_examen_index', [], Response::HTTP_SEE_OTHER);
    }


}
