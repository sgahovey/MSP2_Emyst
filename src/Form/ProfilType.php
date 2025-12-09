<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(message: 'Veuillez entrer votre nom')
                ]
            ])
            ->add('taille', TextType::class, [
                'label' => 'Taille (en cm)',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 100,
                    'max' => 250
                ]
            ])
            ->add('poids', TextType::class, [
                'label' => 'Poids (en kg)',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 30,
                    'max' => 300,
                    'step' => '0.1'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(message: 'Veuillez entrer un email'),
                    new Email(message: 'Veuillez entrer un email valide')
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
