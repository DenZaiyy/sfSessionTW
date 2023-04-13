<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sessions = $entityManager->getRepository(Session::class)->findAll();
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/session/add', name: 'add_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function add(EntityManagerInterface $entityManager, Session $session = null, Request $request): Response
    {
        if (!$session) {
            $session = new Session();
        }

        $form = $this->createForm(SessionType::class, $session); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $session = $form->getData(); //Hydrate l'objet $session avec les données du formulaire
            $entityManager->persist($session); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_session'); // Redirige vers la liste des sessions
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('session/add.html.twig', [
            'formAddSession' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $session->getId()
        ]);
    }

    #[Route('/session/{id}/addStagiaire/{stagiaire_id}', name: 'add_stagiaire_to_session')]
    #[Route('/session/{id}/removeStagiaire/{stagiaire_id}', name: 'remove_stagiaire_to_session')]
    public function stagiaireToSession(EntityManagerInterface $entityManager, Session $session, int $id, int $stagiaire_id): Response
    {
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaire_id); // Récupère le stagiaire à ajouter

        if ($session->getStagiaires()->contains($stagiaire)) { // Vérifie si le stagiaire est déjà dans la session
            $session->removeStagiaire($stagiaire); // Retire le stagiaire de la session
        } else {
            if ($session->getNbPlace() <= $session->getStagiaires()->count()) {
                $this->addFlash('danger', 'La session est déjà complète');
                return $this->redirectToRoute('show_session', ['id' => $id]);
            } else {
                $session->addStagiaire($stagiaire); // Ajoute le stagiaire à la session
            }
        }

        $entityManager->flush(); // Exécute l'insertion en base de données

        return $this->redirectToRoute('show_session', ['id' => $id]); // Redirige vers le détail de la session
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(EntityManagerInterface $entityManager, Session $session): Response
    {
        $entityManager->remove($session); // Prépare la suppression en base de données
        $entityManager->flush(); // Exécute la suppression en base de données
        return $this->redirectToRoute('app_session'); // Redirige vers la liste des sessions
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(EntityManagerInterface $entityManager, Session $session): Response
    {
        $stagiaireNotIn = $entityManager->getRepository(Stagiaire::class)->findByStagiairesNotInSession($session->getId());
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'stagiaires' => $session->getStagiaires(),
            'programmes' => $session->getProgrammes(),
            'stagiairesNotIn' => $stagiaireNotIn
        ]);
    }
}
