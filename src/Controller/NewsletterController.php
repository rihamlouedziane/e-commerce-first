<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Newsletter;
use App\Service\Mailer\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class NewsletterController extends AbstractController
{
    private Mailer $mailer;

    public function __construct(
        #[Autowire(service: 'app.mailer.newsletter')]
        Mailer $mailer
    ) {
        $this->mailer = $mailer;
    }

    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(): Response
    {
        return $this->render('newsletter/index.html.twig');
    }

    #[Route('/register', name: 'app.newsletter.register', methods: ['POST'])]
    public function registerNewsletter(
        #[MapRequestPayload] Newsletter $newsletter
    ): Response {
        $this->mailer->send(
            from: 'newsletter@eheio.ma', // conservé comme dans l’énoncé
            to: $newsletter->email,
            subject: 'New subscriber to the newsletter',
            body: 'A new subscriber has been added to the newsletter.'
        );

        return $this->redirectToRoute('app_newsletter');
    }
} 
