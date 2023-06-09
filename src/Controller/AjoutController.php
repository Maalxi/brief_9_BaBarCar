<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AddCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    #[Route('/addcar', name: 'app_add_car')]
    public function addCar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $car = new Car();
        $pageTitle = 'Proposer un trajet';
        $addCarForm = $this->createForm(AddCarType::class, $car);
        $addCarForm->handleRequest($request);

        $car->setCreated(new \DateTime);

        if ($addCarForm->isSubmitted() && $addCarForm->isValid()) {
            $car->setOwner($this->getUser());

            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('ajout/vehicule.html.twig', [
            'controller_name' => 'AjoutController',
            'page_title' => $pageTitle,
            'addCarForm' => $addCarForm
        ]);
    }

    #[Route('/car_delete_{id}', name: 'app_car_delete')]
    public function deleteCar(EntityManagerInterface $entityManager, int $id): Response
    {

        $repository = $entityManager->getRepository(Car::class);

        $car = $repository->find($id);

        if (!$car) {
            throw $this->createNotFoundException(
                'No car found for id ' . $id
            );
        }

        $entityManager->remove($car);
        $entityManager->flush();

        return $this->redirectToRoute('app_profil');
    }

    #[Route('/car_edit_{id}', name: 'app_car_edit')]
    public function editCar(Request $request, EntityManagerInterface $entityManager, Car $car): Response
    {
        $pageTitle = 'Modifier le Véhicule #' . $car->getId();
        $editCarForm = $this->createForm(AddCarType::class, $car);
        $editCarForm->handleRequest($request);

        // $car->setCreated(new \DateTime);

        if ($editCarForm->isSubmitted() && $editCarForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('edit/vehicule.html.twig', [
            'controller_name' => 'AjoutController',
            'page_title' => $pageTitle,
            'editCarForm' => $editCarForm->createView()
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
