<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FightersController extends AbstractController
{
    #[Route('/fighters', name: 'app_fighters')]
    public function index(): Response
    {
        return $this->render('fighters/index.html.twig', [
            'controller_name' => 'FightersController',
        ]);
    }
}
