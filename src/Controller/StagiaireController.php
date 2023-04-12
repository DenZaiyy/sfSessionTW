<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $stagiaires = $entityManager->getRepository(Stagiaire::class)->findAll();
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    #[Route('/stagiaire/add', name: 'add_stagiaire')]
    #[Route('/stagiaire/{id}/edit', name: 'edit_stagiaire')]
    public function add(EntityManagerInterface $entityManager, Stagiaire $stagiaire = null, Request $request): Response
    {
        if (!$stagiaire) {
            $stagiaire = new Stagiaire();
        }

        $form = $this->createForm(StagiaireType::class, $stagiaire); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $stagiaire = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire
            $entityManager->persist($stagiaire); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_stagiaire'); // Redirige vers la liste des stagiaires
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('stagiaire/add.html.twig', [
            'formAddStagiaire' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $stagiaire->getId()
        ]);
    }

    #[Route('/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    public function delete(EntityManagerInterface $entityManager, Stagiaire $stagiaire): Response
    {
        $entityManager->remove($stagiaire); // Prépare la suppression en base de données
        $entityManager->flush(); // Exécute la suppression en base de données
        // $this->addFlash('success', 'Employé supprimé avec succès'); // Ajoute un message flash
        return $this->redirectToRoute('app_stagiaire'); // Redirige vers la liste des stagiaires
    }

    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire): Response
    {
        $sessions = $stagiaire->getSessionStagiaire();
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' => $stagiaire,
            'sessions' => $sessions
        ]);
    }
}
