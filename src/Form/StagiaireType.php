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
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'w-full p-2.5 rounded-lg']
            ])
            ->add('mail', EmailType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('sexe', TextType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('tel', TelType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('session_stagiaire', EntityType::class, [
                'class' => Session::class,
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'w-full p-2.5 rounded-lg overflow-hidden']
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
