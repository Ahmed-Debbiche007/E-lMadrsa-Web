<?php

namespace App\Controller;

use App\Entity\Attestation;
use App\Form\AttestationType;
use App\Repository\AttestationRepository;
use App\Services\QrcodeService;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/attestation')]
class AttestationController extends AbstractController
{
    #[Route('/', name: 'app_attestation_index', methods: ['GET'])]
    public function index(AttestationRepository $attestationRepository): Response
    {
        return $this->render('attestation/index.html.twig', [
            'attestations' => $attestationRepository->findAll(),
        ]);
    }

    #[Route('/list', name: 'app_attestation_listt')]
    public function listExams(AttestationRepository $attestationRepository)
    {
        return $this->render('back_office/attestations/showAtt.html.twig', [
            'attestations' => $attestationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_attestation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AttestationRepository $attestationRepository): Response
    {
        $attestation = new Attestation();
        $form = $this->createForm(AttestationType::class, $attestation);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $attestationRepository->save($attestation, true);

            return $this->redirectToRoute('app_attestation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attestation/new.html.twig', [
            'attestation' => $attestation,
            'form' => $form,
        ]);
    }

    #[Route('/{idattestation}', name: 'app_attestation_show', methods: ['GET'])]
    public function show(Attestation $attestation): Response
    {
        return $this->render('attestation/show.html.twig', [
            'attestation' => $attestation,
        ]);
    }

    #[Route('/{idattestation}/edit', name: 'app_attestation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Attestation $attestation, AttestationRepository $attestationRepository): Response
    {
        $form = $this->createForm(AttestationType::class, $attestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attestationRepository->save($attestation, true);

            return $this->redirectToRoute('app_attestation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attestation/edit.html.twig', [
            'attestation' => $attestation,
            'form' => $form,
        ]);
    }

    #[Route('/{idattestation}', name: 'app_attestation_delete', methods: ['POST'])]
    public function delete(Request $request, Attestation $attestation, AttestationRepository $attestationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attestation->getIdattestation(), $request->request->get('_token'))) {
            $attestationRepository->remove($attestation, true);
        }

        return $this->redirectToRoute('app_attestation_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/ {idattestation}/pdf', name: 'GenererPDF_app')]
    public function genererPdf(AttestationRepository $attestationRepository,$idattestation,QrcodeService $qrcodeService)
    {

        $qrcode = null ;


        $attestation = $attestationRepository ->find($idattestation);
        $text=$attestation->getParticipation()->getUser()->getNom().$attestation->getParticipation()->getUser()->getPrenom().' '.'aprés sa participation  à la formation '.$attestation->getParticipation()->getFormation()->getSujet().' '.'Par E-LMadrsa';
        $qrcode = $qrcodeService->Qrcode($text);

;
        $html = $this->render('attestation/mypdf.html.twig',[
            'attestation' => $attestation,
            'qrCode' => $qrcode
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        // $name = 'attestation'
        ob_get_clean();
        $dompdf->stream('name.pdf');

    }
}
