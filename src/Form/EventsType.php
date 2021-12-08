<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('date', DateType::class, ['label' => 'Date', 'widget' => 'choice'])
            ->add('np_people_min', TextType::class, ['label' => 'Minimal Number'])
            ->add('np_people_max', TextType::class, ['label' => 'Maximal Number'])
            ->add('duration', TimeType::class, ['label' => 'Duration', 'input' => 'datetime',
                'widget' => 'choice'])
            ->add('level', ChoiceType::class, ['label' => 'Level', 'choices' => [
                'Beginner' => 'level_beginner',
                'Amateur' => 'level_amateur',
                'Confirm' => 'level_confirmed',
                'Professionel' => [
                    'Div1' => 'level_pro_div1',
                    'Div2' => 'level_pro_div2',
                    'Div3' => 'level_pro_div3'
                ]]])
            ->add('age',ChoiceType::class, ['label' => 'Age', 'choices' => [
                '18-25 ans' => 'age_18_25',
                '25-35 ans' => 'age_25_35',
                '35-45ans' => 'age_35_45',
                '+ 45ans' => 'age_45_plus']])
            ->add('save', SubmitType::class, ['label' => 'Create Event']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
