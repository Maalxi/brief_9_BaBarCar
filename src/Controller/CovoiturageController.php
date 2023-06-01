<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CovoiturageController extends AbstractController
{
    #[Route('/covoiturage', name: 'app_covoiturage')]
    public function index(): Response
    {
        return $this->render('covoiturage/index.html.twig', [
            'controller_name' => 'CovoiturageController',
        ]);
    }
    #[Route('/covoiturage_quotidien', name: 'app_quotidien')]
    public function covoiturage_quotidien(): Response
    {
        return $this->render('covoiturage/quotidien.html.twig', [
            'controller_name' => 'CovoiturageController',
        ]);
    }
    #[Route('/bus', name: 'app_bus')]
    public function bus(): Response
    {
        return $this->render('covoiturage/bus.html.twig', [
            'controller_name' => 'CovoiturageController',
        ]);
    }
}
