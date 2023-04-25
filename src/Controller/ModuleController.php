<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Categorie;
use App\Form\ModuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(): Response
    {
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
        ]);
    }

    #[Route('/categorie/{id}/module/add', name: 'add_module')]
    public function addModule(EntityManagerInterface $entityManager, Module $module = null, int $id, Request $request): Response
    {
        $module = new Module();

        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        $form = $this->createForm(ModuleType::class, $module); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $module = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire

            $module->setCategorie($categorie);
            $entityManager->persist($module); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_programme'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('module/add.html.twig', [
            'formAddModule' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $module->getId()
        ]);
    }
    #[Route('/module/{id}/edit', name: 'edit_module')]
    public function editModule(EntityManagerInterface $entityManager, Module $module = null, Request $request): Response
    {
        $form = $this->createForm(ModuleType::class, $module); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $module = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire
            $entityManager->persist($module); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_programme'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('module/add.html.twig', [
            'formAddModule' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $module->getId()
        ]);
    }

    #[Route('/module/{id}/delete', name: 'delete_module')]
    public function deleteModule(EntityManagerInterface $entityManager, Module $module): Response
    {
        $entityManager->remove($module); // Prépare la suppression en base de données
        $entityManager->flush(); // Exécute la suppression en base de données
        return $this->redirectToRoute('app_programme'); // Redirige vers la liste des programmes
    }
}
