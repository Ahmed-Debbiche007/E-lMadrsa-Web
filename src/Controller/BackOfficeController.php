<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackOfficeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_back_office')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user){

            return $this->redirect('/login');
        }
/*
        if(!$user->isAdmin()){
            return $this->redirect('/');
        }
*/
        return $this->render('back_office/dashboard.html.twig', [
            'controller_name' => 'BackOfficeController',
        ]);
    }
}
