<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;
use App\Repository\ParticipationRepository;


class DoughnutController extends AbstractController
{
    #[Route('/doughnut', name: 'app_doughnut')]
    public function index(): Response
    {
        return $this->render('doughnut/index.html.twig', [
            'controller_name' => 'DoughnutController',
        ]);
    }
    #[Route('/chaima', name: 'app_doughnut', methods: ['GET'])]
    public  function getdoughnut(FormationRepository $formationRepository,ParticipationRepository $participationRepository){

        return $this->render('front_office/formations/doughnut.html.twig',["formations"=>$formationRepository->findAll(),
            "countParticipation"=>$participationRepository->ParticipationByForm($formationRepository),"SommeRes"=>$participationRepository->getSumresultatParFormation()]);



    }
}
