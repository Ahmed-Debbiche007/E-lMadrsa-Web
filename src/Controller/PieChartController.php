<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PieChartController extends AbstractController
{
    #[Route('/pie/chart', name: 'app_pie_chart')]
    public function index(): Response
    {
        return $this->render('pie_chart/index.html.twig', [
            'controller_name' => 'PieChartController',
        ]);
    }

    #[Route('/piechart', name: 'app_examen_piechart', methods: ['GET'])]
    public function getPieChart( CategorieRepository $categorieRepository,ExamenRepository $examenRepository): Response
    {
         return $this->render('back_office/examen/piechart.html.twig', ["categorie"=>$categorieRepository->findAll()

       ,"countExams"=>$examenRepository->examsbyCategorie($categorieRepository),"allexamscount"=>$examenRepository->countexams()]);
    }
}
