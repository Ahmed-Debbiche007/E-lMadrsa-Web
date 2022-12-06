<?php

namespace App\Controller;

use App\Repository\ParticipationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{



    #[Route('/calendar1', name: 'app_calendar')]
    public function index1(ParticipationRepository $participationRepository)
    {
        $events = $participationRepository->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'title' => $event->getUser()->getNom()." / ".$event->getFormation()->getSujet(),
                'resultat' => $event->getResultat(),
                'start' =>($event->getDatePart())?->format('Y-m-d') ?? '',
                'end' =>($event->getDatePart())?->format('Y-m-d') ?? '',

            ];
        }

        $data = json_encode($rdvs);

        return $this->render('back_office/calendar/calendar.html.twig', compact('data'));
    }



}
