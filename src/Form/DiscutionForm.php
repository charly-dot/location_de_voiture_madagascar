<?php

namespace App\Form;

use App\Entity\Discution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscutionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('discution', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => ['rows' => 5, 'class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez écrire un message.']),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 1000,
                        'minMessage' => 'Votre message est trop court (minimum {{ limit }} caractères).',
                        'maxMessage' => 'Votre message est trop long (maximum {{ limit }} caractères).',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer une adresse email.']),
                    new Assert\Email(['message' => 'Adresse email invalide.']),
                ],
            ])
            ->add('contact', TelType::class, [

                
                'label' => 'Contact téléphonique',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer votre numéro de téléphone.']),
                    new Assert\Length([
                        'min' => 6,
                        'max' => 20,
                        'minMessage' => 'Numéro trop court.',
                        'maxMessage' => 'Numéro trop long.',
                    ]),
                ],
            ])
            ->add('envoye', SubmitType::class, [
                'label' => 'Valider le commanter',
                'attr' => ['class' => 'btn btn-primary']
            ]);
            // ->add('id_vehicule') // à gérer automatiquement dans ton contrôleur
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Discution::class,
        ]);
    }
}
