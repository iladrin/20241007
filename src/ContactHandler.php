<?php

namespace App;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

readonly class ContactHandler
{
    public function __construct(
        private MailerInterface $mailer,
        private LoggerInterface $logger,
        #[Autowire(param: 'app.contact_email')] private string $contactEmail
    )
    {

    }

    public function handle(array $data): void
    {
        $this->logger->debug('Sending contact email');

        $email = (new Email())
            ->from($data['email'])
            ->to($this->contactEmail)
            ->subject('Contact')
            ->html($data['message']);

        $this->mailer->send($email);
    }
}