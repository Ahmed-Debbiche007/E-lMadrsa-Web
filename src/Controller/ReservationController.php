<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('')]
class ReservationController extends AbstractController
{
    #[Route('/reservationFront', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    #[Route('/reservation/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservationRepository $reservationRepository): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->save($reservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }





    #[Route('/reservation/newRes/{idEv}', name: 'app_reservation_newRes', methods: ['GET', 'POST'])]
    public function newRes(Request $request, ReservationRepository $reservationRepository,$idEv): Response
    {
        $reservation = new Reservation();
      $reservation->setIdUtilisateur(5);
      $reservation->setIdEvenement($idEv);
      $date = new \DateTime('now');
      $reservation->setDateReservation($date);

       
            $reservationRepository->save($reservation, true);

            return $this->redirectToRoute('pdf', ['id' => $reservation->getIdEvenement()], Response::HTTP_SEE_OTHER);
        

      
    }









    #[Route('/dashboard/reservation/{idReservation}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/dashboard/reservation/{idReservation}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->save($reservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/reservation/{idReservation}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getIdReservation(), $request->request->get('_token'))) {
            $reservationRepository->remove($reservation, true);
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }








    /*

    #[Route('/reservation/{idReservation}/CodeQr', name: 'app_reservation_CodeQr', methods: ['GET'])]
    public function CodeQr(Request $request, QrcodeService $qrcodeService,ReservationRepository $reservationRepository): Response
    {
        $qrCode = null;
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $reservation = $doctrine->getRepository(Reservation::class)->findAllGreaterThanPrice($idReservation);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'qrCode' => $qrCode
        ]);
    }*/
}
