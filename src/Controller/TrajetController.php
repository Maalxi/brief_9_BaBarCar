<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrajetController extends AbstractController
{
    #[Route('/trajet', name: 'app_trajet')]
    public function index(): Response
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }
    #[Route('/publication', name: 'app_publication')]
    public function publication(): Response
    {
        return $this->render('trajet/publication.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }
}
