<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'w-full p-2.5 rounded-lg']
            ])
            ->add('mail', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('sexe', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('tel', TelType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('session_stagiaire', EntityType::class, [
                'class' => Session::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false, // rendre le champ non obligatoire
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'bg-slate-900 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300 w-full mt-5'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
