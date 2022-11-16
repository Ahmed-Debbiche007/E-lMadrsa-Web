<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class SendMailController extends AbstractController
{
    #[Route('/send/mail', name: 'app_send_mail')]
    public function index(): Response
    {
        return $this->render('send_mail/index.html.twig', [
            'controller_name' => 'SendMailController',
        ]);
    }
    #[Route('/send/mail', name: 'app_send_mail')]
    public function send(Email $email): Response
    {
        $email->getHeaders()->addTextHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply');
        $transport = Transport::fromDsn($this->getParameter('app.dsn'));
        $mailer = new Mailer($transport);
        try{
            $mailer->send($email);
        }catch(TransportExceptionInterface $e){
            dd($e);
        };
        return new Response($this->getParameter('app.dsn'));
    }
}
