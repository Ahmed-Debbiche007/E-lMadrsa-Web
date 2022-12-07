<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;
use App\Repository\ParticipationRepository;


class ChartController extends AbstractController
{
    #[Route('/chart', name: 'app_chart')]
    public function index(): Response
    {
        return $this->render('chart/index.html.twig', [
            'controller_name' => 'ChartController',
        ]);
    }

    #[Route('/ChartsForm', name: 'app_formation_Chart', methods: ['GET'])]
    public function getStatsForm( FormationRepository $formationRepository,ParticipationRepository $participationRepository){
        return $this->render('front_office/formations/chartForm.html.twig',["formations"=>$formationRepository->findAll(),
            "countParticipation"=>$participationRepository->ParticipationByForm($formationRepository)]);

    }
}
