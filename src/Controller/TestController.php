<?php

namespace App\Controller;

use App\Repository\AttestationRepository;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;




class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/Best_Form', name: 'BestForm_app')]
    public function BestForm(ParticipationRepository $participationRepository,FormationRepository $formationRepository)
    {

        $Participation = $participationRepository->getFormByParticipation();
        //$idForm = $formationRepository ->getId($participationRepository);
        $id = $participationRepository ->getFormByParticipation1();
        $idForm = $formationRepository->find($id);

        return $this->render("front_office/formations/BestForm.html.twig",['formation'=>$Participation,'nomform'=>$idForm]);




    }


    public function showFormationByCat(FormationRepository $repo,$id,CategorieRepository $categorieRepository)
    {
        $categorie = $categorieRepository->find($id);
        $formations= $repo->getFormationByCat($id);
        return $this->render("front_office/formations/course.html.twig",
            array('categorie'=>$categorie,
                'categories' => $categorieRepository->findAll(),
                'formations'=>$formations)
        );

    }






}
