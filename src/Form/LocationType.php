<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Voiture;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;  // Correctly import the EntityType form type
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    // public function buildForm(FormBuilderInterface $builder, array $options): void
    // {
    //     $builder
    //         ->add('date_debut')
    //         ->add('date_retour')
    //         ->add('prix')
    //         ->add('voiture')
    //         ->add('client')
    //     ;
    // }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut')
            ->add('date_retour')
            ->add('prix')
            // Correctly render Voiture entity as a dropdown
            ->add('voiture', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => 'modele',  // Replace with the appropriate property of Voiture
                'placeholder' => 'Select a Voiture',  // Optional
            ])
            // Correctly render Client entity
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',  // Replace with the appropriate property of Client
                'placeholder' => 'Select a Client',  // Optional
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
