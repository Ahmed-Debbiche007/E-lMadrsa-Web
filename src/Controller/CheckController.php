<?php

namespace App\Controller;



use App\Entity\check;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckController extends AbstractController
{
    #[Route('/check', name: 'app_check')]
    public function index(): Response
    {/* default constructor */
      $check = new Check();
        $hasProfanity = $check->hasProfanity('faqsjdjshdsqjhdjbihghghghghtch');



        return new Response($hasProfanity);
    }
}
