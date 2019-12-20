<?php


namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;


class MailerService
{
    protected $mailer;
    private $template;

    public function __construct(MailerInterface $mailer, Environment $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    public function sendMissionEnrollment($from, $to, $user, $subject, $mission)
    {
        $view = 'email/enrollmentConfirmation.html.twig';
        $email = new Email();
        $email
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($this->template->render($view, [
                'user' => $user,
                'mission' => $mission,
            ]));

        $this->mailer->send($email);
    }
}