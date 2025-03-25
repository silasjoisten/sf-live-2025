<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(Request $request): Response
    {
        return $this->render('index.html.twig', [
            'locale' => $request->getLocale(),
        ]);
    }
}
