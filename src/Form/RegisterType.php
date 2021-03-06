<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'constraints' => new Length(['min' => 2,'max' => 50, ]),
                'attr' => [
                    'placeholder' => 'Please enter your firstname'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Name',
                'constraints' => new Length(['min' => 2,'max' => 50, ]),
                'attr' => [
                    'placeholder' => 'Please enter your name'
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo',
                'constraints' => new Length(['min' => 2,'max' => 50, ]),
                'attr' => [
                    'placeholder' => 'Please enter pseudo'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => new Length(['min' => 2,'max' => 60, ]),
                'attr' => [
                    'placeholder' => 'Please enter your mail address'
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adress',
                'constraints' => new Length(['min' => 2,'max' => 80, ]),
                'attr' => [
                    'placeholder' => 'Please enter your address'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'constraints' => new Length(['min' => 2,'max' => 20, ]),
                'attr' => [
                    'placeholder' => 'Please enter your city'
                ]
            ])
            ->add('zipcode', NumberType::class, [
                'label' => 'zipcode',
                'constraints' => new Length(['min' => 2,'max' => 5, ]),
                'attr' => [
                    'placeholder' => 'Please enter your zipcode'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Passwords must be the same',
                'label' => 'Password',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Please enter your password'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm Password',
                    'attr' => [
                        'placeholder' => 'Please reenter your password'
                    ]
                ],
                
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

