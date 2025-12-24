<?php

declare(strict_types=1);

namespace App\Controller;
use App\DTO\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;


final class DefaultController extends AbstractController
{



#[Route('/default', name: 'app_default')]
public function index(#[MapQueryString] Pagination $pagination): Response
{
    dump($pagination);

    return $this->render('default/index.html.twig', [
        'controller_name' => 'DefaultController',
    ]);
}
}
