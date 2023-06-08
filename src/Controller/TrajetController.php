<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Form\PublicationTrajetFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    // Publier un nouveau trajet

    #[Route('/publication', name: 'app_publication')]
    public function publication(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $publication = new Ride();

        $form = $this->createForm(PublicationTrajetFormType::class, $publication);

        // Ecoute la soumission du formulaire
        $form->handleRequest($request);

        $publication->setCreated(new \DateTime);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setDriver($this->getUser());
            $publication = $form->getData();
            $entityManagerInterface ->persist($publication);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_details', ['Id' => $publication->getId()]);
        }

        return $this->render('trajet/publication.html.twig', [
            'controller_name' => 'TrajetController',
            'form' => $form,
        ]);
    }

    // Editer un trajet

    
}