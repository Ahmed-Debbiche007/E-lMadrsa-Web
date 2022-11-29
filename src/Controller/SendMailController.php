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
    #[Route('/send/mail', name: 'app.app')]
    public function index(): Response
    {
        return $this->render('send_mail/index.html.twig', [
            'controller_name' => 'SendMailController',
        ]);
    }

    public function send(Email $email)
    {
        $email->getHeaders()->addTextHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply');
        $transport = Transport::fromDsn('gmail://springforfever@gmail.com:kmcovmkdwmxwscsz@default?verify_peer=0');
        $mailer = new Mailer($transport);
        try{
            $mailer->send($email);
        }catch(TransportExceptionInterface $e){
            dd($e);
        };
    }
}
