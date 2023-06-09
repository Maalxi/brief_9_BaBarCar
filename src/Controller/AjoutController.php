<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutController extends AbstractController
{
    #[Route('/ajout_vehicule', name: 'app_ajout_vehicule')]
    public function ajout_vehicule(): Response
    {
        return $this->render('ajout/vehicule.html.twig', [
            'controller_name' => 'AjoutController',
        ]);
    }
    #[Route('/ajout_regle', name: 'app_ajout_regle')]
    public function ajout_regle(): Response
    {
        return $this->render('ajout/regle.html.twig', [
            'controller_name' => 'AjoutController',
        ]);
    }
}
