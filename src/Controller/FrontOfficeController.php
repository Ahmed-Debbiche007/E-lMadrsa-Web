<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EvenementRepository $evenementRepository): Response
    {

        return $this->render('front_office/index.html.twig', [
            'controller_name' => 'FrontOfficeController','evenements' => $evenementRepository->findAll(),
        ]);
    }




}
