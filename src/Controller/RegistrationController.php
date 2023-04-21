<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

			$avatar = $form->get('image')->getData();

			if ($avatar) {
				$originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
				// this is needed to safely include the file name as part of the URL
				// $safeFilename = $slugger->slug($originalFilename);
				$newFilename = uniqid() . '.' . $avatar->guessExtension();

				// Move the file to the directory where brochures are stored
				try {
					$avatar->move(
						$this->getParameter('avatar_directory'),
						$newFilename
					);
				} catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// updates the 'brochureFilename' property to store the PDF file name
				// instead of its contents
				$user->setAvatar($newFilename);

				$entityManager->persist($user); // Prépare l'insertion en base de données
				$entityManager->flush();
			}

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
