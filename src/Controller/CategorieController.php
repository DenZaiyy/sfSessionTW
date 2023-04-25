<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/add', name: 'add_categorie')]
    public function addCategory(EntityManagerInterface $entityManager, FileUploader $fileUploader, Request $request): Response
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $categorie = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire

            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('image')->getData();

            if ($avatarFile) {
                $avatarFileName = $fileUploader->upload($avatarFile);

                $categorie->setImage($avatarFileName);
            }

            $entityManager->persist($categorie); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_programme'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('categorie/add.html.twig', [
            'formAddCategorie' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $categorie->getId()
        ]);
    }

    #[Route('/categorie/{id}/edit', name: 'edit_categorie')]
    public function editCategory(EntityManagerInterface $entityManager, Categorie $categorie, FileUploader $fileUploader, Request $request): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie); // Crée le formulaire
        $form->handleRequest($request); // Récupère les données du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Vérifie que le formulaire a été soumis et qu'il est valide
            $categorie = $form->getData(); //Hydrate l'objet $entreprise avec les données du formulaire

            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('image')->getData();

            if ($avatarFile) {
                $avatarFileName = $fileUploader->upload($avatarFile);

                $categorie->setImage($avatarFileName);
            }

            $entityManager->persist($categorie); // Prépare l'insertion en base de données
            $entityManager->flush(); // Exécute l'insertion en base de données
            return $this->redirectToRoute('app_programme'); // Redirige vers la liste des entreprises
        }

        // vue pour afficher le formulaire d'ajout
        return $this->render('categorie/add.html.twig', [
            'formAddCategorie' => $form->createView(), // Envoie le formulaire à la vue
            'edit' => $categorie->getId()
        ]);
    }

    #[Route('/categorie/{id}/delete', name: 'delete_categorie')]
    public function deleteCategory(EntityManagerInterface $entityManager, Categorie $categorie): Response
    {
        $entityManager->remove($categorie); // Prépare la suppression en base de données
        $entityManager->flush(); // Exécute la suppression en base de données
        return $this->redirectToRoute('app_programme'); // Redirige vers la liste des programmes
    }

    #[Route('/categorie/{id}', name: 'show_categorie')]
    public function showCategory(Categorie $categorie): Response
    {
        $modules = $categorie->getModules();
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'modules' => $modules
        ]);
    }
}
