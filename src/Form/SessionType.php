<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
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
            ->add('stagiaires', EntityType::class, [
                'class' => Stagiaire::class,
                'multiple' => true,
                'required' => false, // rendre le champ non obligatoire
                'choice_label' => 'fullName',
                'attr' => ['class' => 'mt-5 w-full p-2.5 rounded-lg overflow-hidden']
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
