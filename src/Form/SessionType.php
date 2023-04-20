<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', null, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('nb_place', IntegerType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'w-full p-2.5 rounded-lg']
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'w-full p-2.5 rounded-lg']
            ])
			->add('programmes', CollectionType::class, [
				// la collection attend l'élément qu'elle entrera dans le form
				// ce n'est pas obligatoire que ce soit un autre form
				'entry_type' => ProgrammeType::class,

				'prototype' => true,
				// autorisé l'ajout de nouveau élément dans l'entité session qui seront persister grâce au cascade_persist sur l'élément programme
				// va activer un data prototype qui sera un attribut html qu'on pourra manipuler en JS

				'allow_add' => true,
				'allow_delete' => true,

				'by_reference' => false, // il est obligatoire car Session n'a pas de setProgramme mais c'est Programme qui contient setSession
				// c'est Programme est propriétaire de la relation
				// Pour éviter un mapping false, on est obligé de rajouter un by_reference false
			])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'bg-slate-900 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300 w-full mt-5'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
