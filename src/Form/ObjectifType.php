<?php

namespace App\Form;

use App\Entity\Objectif;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valeur_cible')
            ->add('date_limite', null, [
                'widget' => 'single_text',
            ])
            ->add('type_objectif')
            // ❌ On supprime complètement :
            // ->add('user', EntityType::class, [...])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objectif::class,
        ]);
    }
}

