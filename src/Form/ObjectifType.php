<?php

namespace App\Form;

use App\Entity\Objectif;
use App\Entity\User;
use App\Enum\TypeObjectifEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
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
            ->add('type_objectif', EnumType::class, [
                'class' => TypeObjectifEnum::class,
                'choice_label' => function (TypeObjectifEnum $enum): string {
                    return $enum->value;
                },
            ])
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

