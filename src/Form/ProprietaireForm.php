<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Proprietaire;

class ProprietaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le nom est requis.']),
                new Assert\Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le nom ne doit pas dépasser {{ limit }} caractères.',
                ])
            ]
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prénom',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le prénom est requis.']),
                new Assert\Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le prénom ne doit pas dépasser {{ limit }} caractères.',
                ])
            ]
        ])
        ->add('cin', IntegerType::class, [
            'label' => 'CIN',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le CIN est requis.']),
                new Assert\Length([
                    'min' => 2,
                    'max' => 12,
                    'exactMessage' => 'Le CIN doit contenir exactement {{ limit }} caractères.',
                ]),
                new Assert\Regex([
                    'pattern' => '/^\d+$/',
                    'message' => 'Le CIN doit contenir uniquement des chiffres.',
                ])
            ]
        ])
        ->add('tel', IntegerType::class, [
            'label' => 'Téléphone',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le numéro de téléphone est requis.']),
                new Assert\Length([
                    'min' => 6,
                    'max' => 15,
                    'exactMessage' => 'Le numéro doit contenir exactement {{ limit }} chiffres.',
                ]),
                new Assert\Regex([
                    'pattern' => '/^\d+$/',
                    'message' => 'Le numéro doit contenir uniquement des chiffres.',
                ])
            ]
        ])
        
        ->add('contatrat', ChoiceType::class, [
            'label' => 'Type de contrat',
            'choices'  => [
                'CDD' => 'CDD',
                'CDI' => 'CDI',
            ],
            'placeholder' => 'Choisissez un type de contrat',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le contrat est requis.']),
                new Assert\Choice([
                    'choices' => ['CDD', 'CDI'],
                    'message' => 'Veuillez choisir un contrat valide.',
                ])
            ]
        ])
        ->add('idVehicule', IntegerType::class, [
            'label' => 'ID Véhicule',
            'data' => 1,
            'attr' => ['readonly' => true],
            'constraints' => [
                new Assert\NotBlank(['message' => 'L’ID du véhicule est requis.']),
                new Assert\Positive(['message' => 'L’ID doit être un nombre positif.'])
            ]
        ])
        ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proprietaire::class,
        ]);
    }
}
