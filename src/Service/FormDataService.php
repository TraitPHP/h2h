<?php

namespace App\Service;


use App\Entity\FormData;
use Symfony\Component\Mailer\MailerInterface;

class FormDataService
{
    private $mailer;

    /**
     * FormDataService constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param FormData $formData
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * TODO: error handler & return
     */
    public function sendFormDataMail(FormData $formData): void
    {
        $email = (new Email())
            ->from($formData->getEmail())
            ->to('kontakt@h2h.tech')
            ->subject($formData->getSubject())
            ->text($formData->getMessage());

        $this->mailer->send($email);
    }
}