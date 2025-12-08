<?php

namespace App\Form;

use App\Entity\Seance;
use App\Enum\TypeSeanceEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_entrainement', null, [
                'widget' => 'single_text',
            ])
            ->add('type_seance', EnumType::class, [
                'class' => TypeSeanceEnum::class,
                'choice_label' => function (TypeSeanceEnum $enum): string {
                    return $enum->value;
                },
            ])
            ->add('duree', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
