<?php

namespace App\Form;

use App\Entity\Discution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscutionsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('discution', TextareaType::class, [
            'required' => true,
            'label' => 'Votre commentaire',
        ])
            ->add('email')
            ->add('contact')
            // ->add('id_vehicule')
            // ->add('confirmation')
            ->add('envoye', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Discution::class,
        ]);
    }
}
