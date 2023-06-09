<?php

namespace App\Controller;

use App\Form\EditProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/edit_profil', name: 'app_edit_profil')]
    public function edit_profil(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        /** @var PasswordAuthenticatedUserInterface $user */
        $user = $this->security->getUser();

        $pageTitle = 'Modifier Votre Profil' . $user->getId();
        $editUserForm = $this->createForm(EditProfilFormType::class, $user);
        $editUserForm->handleRequest($request);

        if ($editUserForm->isSubmitted() && $editUserForm->isValid()) {

            if (!empty($editUserForm['plainPassword']->getData())) {
                $password = $userPasswordHasher->hashPassword($user, $editUserForm['plainPassword']->getData());
                $user->setPassword($password);
            }

            $entityManager->flush();
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('edit/profil.html.twig', [
            'controller_name' => 'EditController',
            'page_title' => $pageTitle,
            'editUserForm' => $editUserForm->createView()
        ]);
    }
    
    #[Route('/edit_vehicule', name: 'app_edit_vehicule')]
    public function edit_vehicule(): Response
    {
        return $this->render('edit/profil.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }

    #[Route('/edit_regle', name: 'app_edit_regle')]
    public function edit_regle(): Response
    {
        return $this->render('edit/profil.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }

    #[Route('/edit_trajet', name: 'app_edit_trajet')]
    public function edit_trajet(): Response
    {
        return $this->render('edit/profil.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }
}
