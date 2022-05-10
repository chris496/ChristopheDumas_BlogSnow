<?php

namespace App\Services;

use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailerService
{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/mailer", name="app_mailer")
     */
    public function sendMail($email, $token)
    {
        $email = (new TemplatedEmail())
                ->from('administrateur@p2.christophedumas1.fr')
                ->to(new Address($email))
                ->subject('Thanks for signing up!')

            // path of the Twig template to render
                ->htmlTemplate('emails/registration.html.twig')

            // pass variables (name => value) to the template
                ->context([
                    'token' => $token,
                ])
            ;

            $this->mailer->send($email);
    }
}
