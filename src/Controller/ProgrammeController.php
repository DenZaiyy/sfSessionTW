<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Categorie;
use App\Entity\Programme;
use App\Form\ProgrammeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    #[Route('/programme', name: 'app_programme')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $programmes = $entityManager->getRepository(Programme::class)->findAll();
        return $this->render('programme/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }

    #[Route('/programme/add', name: 'add_programme')]
    #[Route('/programme/{id}/edit', name: 'edit_programme')]
    public function add(EntityManagerInterface $entityManager, Programme $programme = null, Request $request): Response
    {
        if (!$programme) {
            $programme = new Programme();
        }

        $form = $this->createForm(ProgrammeType::class, $programme); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $programme = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire
            $entityManager->persist($programme); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_programme'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('programme/add.html.twig', [
            'formAddProgramme' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $programme->getId()
        ]);
    }

    #[Route('/categorie/add', name: 'add_categorie')]
    #[Route('/categorie/{id}/edit', name: 'edit_categorie')]
    public function addCategory(EntityManagerInterface $entityManager, Categorie $categorie = null, Request $request): Response
    {
        if (!$categorie) {
            $categorie = new Categorie();
        }

        $form = $this->createForm(CategorieType::class, $categorie); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $categorie = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire
            $entityManager->persist($categorie); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_categorie'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('programme/addCategory.html.twig', [
            'formAddCategorie' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $categorie->getId()
        ]);
    }

    #[Route('/module/add', name: 'add_module')]
    #[Route('/module/{id}/edit', name: 'edit_module')]
    public function addModule(EntityManagerInterface $entityManager, Module $module = null, Request $request): Response
    {
        if (!$module) {
            $module = new Module();
        }

        $form = $this->createForm(ModuleType::class, $module); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $module = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire
            $entityManager->persist($module); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_module'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('programme/addModule.html.twig', [
            'formAddModule' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $module->getId()
        ]);
    }

    #[Route('/programme/{id}/delete', name: 'delete_programme')]
    public function delete(EntityManagerInterface $entityManager, Programme $programme): Response
    {
        $entityManager->remove($programme); // Prépare la suppression en base de données
        $entityManager->flush(); // Exécute la suppression en base de données
        return $this->redirectToRoute('app_programme'); // Redirige vers la liste des programmes
    }

    #[Route('/programme/{id}', name: 'show_programme')]
    public function show(Programme $programme): Response
    {
        return $this->render('programme/show.html.twig', [
            'programme' => $programme
        ]);
    }
}
