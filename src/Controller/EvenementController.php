<?php

namespace App\Controller;
use Twilio\Rest\Client;
use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/')]
class EvenementController extends AbstractController
{
    #[Route('dashboard/evenement/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $sql = 'SELECT count(*) as nbr,c.type_evenement as type FROM evenement e inner join categorie_ev c on e.id_cate_id=c.id group by id_cate_id';
        $em = $this->getDoctrine()->getManager();
        $listStat=$em->getConnection()->executeQuery($sql)->fetchAll();
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
            'stat' => $listStat
        ]);
    }

    #[Route('evenement/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EvenementRepository $evenementRepository): Response
    {
        $evenement = new Evenement();
        $evenement->setEtatEvenement('en cours');
        $form = $this->createForm(EvenementType::class, $evenement);
        $evenement->setEtatEvenement("En cours");
        $user = $this->getUSer();
        $evenement->setIdUser($user);
        //dd($evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $evenement->setImage($newFilename);
            }

            $evenementRepository->save($evenement, true);

            return $this->redirectToRoute('sms', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('dashboard/evenement/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('dashboard/evenement/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $evenement->setImage($newFilename);
            }
            $evenementRepository->save($evenement, true);

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('dashboard/evenement/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $evenementRepository->remove($evenement, true);
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }


    

    #[Route('SMS', name: 'sms')]
    public function sendSMS(): Response
    {
        $account_sid = 'ACc2294319aa2eaba8e91273055538a50e';
        $auth_token = 'd4eedf31a0b4695cebf3c74b36b410a2';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
        
        // A Twilio number you own with SMS capabilities
        $twilio_number = "+18654137235";
        
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+21655105372',
            array(
                'from' => $twilio_number,
                'body' => 'nouvelle evenement a ete ajouté'
            )
        ); 
        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('PDF/{id}', name: 'pdf')]
    public function indexAction(Request $request,$id,EvenementRepository $evenementRepository)
    {
        $ev=$evenementRepository->find($id);
        
        $pdf = new \FPDF();

        $pdf->AddPage();
        $pdf->Image('C:/ticket.jpg', 0, 0, 200);
        $pdf->SetFont('Arial','B',30);
        $pdf->Cell(17,10,$ev->getNomEvenement());
        $d = $ev->getDate()->format('d');
        $m = $ev->getDate()->format('m');
        $y = $ev->getDate()->format('Y');
        $pdf->Cell(1,60,$d);
        $pdf->Cell(-10,80,$m);
        $pdf->Cell(28,100,$y);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

}
