<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
    private MailerInterface $mailer;
    private string $fromAddress;

    public function __construct(MailerInterface $mailer, string $fromAddress)
    {
        $this->mailer = $mailer;
        $this->fromAddress = $fromAddress;
    }

    public function send(string $from, string $to, string $subject, string $body): void
    {
        $message = $this->doCreateMessage(
            $this->fromAddress,
            $to,
            $subject,
            $body
        );

        $this->mailer->send($message);
    }

    public function sendWithAttachment(
        string $from,
        string $to,
        string $subject,
        string $body,
        array $attachments
    ): void {
        $message = $this->doCreateMessage($from, $to, $subject, $body);

        foreach ($attachments as $attachment) {
            $message->attachFromPath($attachment);
        }

        $this->mailer->send($message);
    }

    private function doCreateMessage(
        string $from,
        string $to,
        string $subject,
        string $body
    ): Email {
        return (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($body);
    }
}
