<?php

namespace App\Controller;

use App\Repository\RideRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ride;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CovoiturageController extends AbstractController
{
    #[Route('/covoiturage', name: 'app_covoiturage')]
    public function index(RideRepository $rideRepository): Response
    {
        $rides = $rideRepository->findAll();

        return $this->render('covoiturage/index.html.twig', [
            'controller_name' => 'CovoiturageController',
            'rides' => $rides,
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
    #[Route('/details', name: 'app_details')]
    public function details(RideRepository $rideRepository,Request $request): Response
    {
        $rideId = ($request->query->get("Id"));
        $rides = $rideRepository->findOneBy(['id' => $rideId]);

        return $this->render('/covoiturage/details.html.twig', [
            'controller_name' => 'CovoiturageController',
            'rides' => $rides
        ]);
    }
}