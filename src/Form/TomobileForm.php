<?php

namespace App\Form;

use App\Entity\Proprietaire;
use App\Entity\Tomobiles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class TomobileForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageConstraints = [
            new Assert\Image([
                'maxSize' => '5M',
                'mimeTypesMessage' => 'Veuillez sélectionner une image valide (jpeg, png, etc.)',
            ])
        ];

        $builder
            ->add('type', TextType::class, [
                'label' => 'Type de véhicule',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
            ])
            ->add('categorie', TextType::class, [
                'label' => 'Catégorie',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
            ])
            ->add('place', IntegerType::class, [
                'label' => 'Places',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Positive(),
                ],
            ])
            ->add('motereur', TextType::class, [
                'label' => 'Type de moteur',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
            ])
            ->add('marque', TextType::class, [
                'label' => 'Marque',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image principale',
                'required' => false,
                'constraints' => $imageConstraints,
                'data_class' => null,
            ])
            ->add('image2', FileType::class, [
                'label' => 'Image secondaire 1',
                'required' => false,
                'constraints' => $imageConstraints,
                'data_class' => null,
            ])
            ->add('image3', FileType::class, [
                'label' => 'Image secondaire 2',
                'required' => false,
                'constraints' => $imageConstraints,
                'data_class' => null,
            ])
            ->add('image4', FileType::class, [
                'label' => 'Image secondaire 3',
                'required' => false,
                'constraints' => $imageConstraints,
                'data_class' => null,
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix (en Ariary)',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Positive(),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 10]),
                ],
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaire::class,
                'choice_label' => 'name',
                'label' => 'Propriétaire',
                'placeholder' => 'Sélectionner un propriétaire',
                'constraints' => [
                    new Assert\NotNull(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tomobiles::class,
        ]);
    }
}
