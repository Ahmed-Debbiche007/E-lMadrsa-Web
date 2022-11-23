<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Form\ReclamationType1;
use App\Repository\CategorieRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReclamationRepository;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/rec', name: 'app_reclamationsss_show', methods: ['GET'])]
    public function showreclmations(ReclamationRepository $reclamationRepository)
    {
        $user = $this->getUser();
        if (!$user){
            return $this->redirect('/login');
        }
        return $this->render('front_office/reclamation/mesreclamations.html.twig',["reclamations"=>$reclamationRepository->findByUserId($user->getId())]);

    }
    #[Route('/add', name: 'app_reclamations_add')]
    public function addrec(MailerInterface $mailer,Request $request, ReclamationRepository $reclamationRepository, Security $security): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType1::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDaterec(new \DateTime('now'));

          $reclamation->setIduser( $this->getUser());
            $reclamationRepository->save($reclamation, true);
            $user=$this->getUser();
            $emaiiil = $user->getEmail();
            $email = (new Email())
                ->from('springforfever@gmail.com')
                ->to($emaiiil)
                ->subject($reclamation->getSujet())
                ->text($reclamation->getDescription());

            $mailer->send($email);

            return $this->redirectToRoute('app_reclamations_add', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('front_office/reclamation/addrec.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);

    }
    #[Route('/list/', name: 'app_reclamations_listt')]
    public function listrec(ReclamationRepository $reclamationRepository, )
    {
        return $this->render('front_office/reclamation/reclamation.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),

        ]);
    }


    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('back_office/reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationRepository $reclamationRepository): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDaterec(new \DateTime('now'));
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{idreclamation}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('back_office/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


/*

    #[Route('/list/{idreclamation}', name: 'app_reclamation_show_front', methods: ['GET'])]
    public function showFront(Reclamation $reclamation , ReclamationRepository $reclamationRepository): Response
    {
        $reclamation=$reclamationRepository->find()
        return $this->render('front_office/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
*/

    #[Route('/{idreclamation}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{idreclamation}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }




}
