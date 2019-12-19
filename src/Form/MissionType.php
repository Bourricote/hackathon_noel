<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Planet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '6'
                ]
            ])
            ->add('transport')
            ->add('departureDate', null, ['attr'=>[
                'class' => 'datepicker'
    ]])
            ->add('returnDate', null, ['attr'=>[
                'class' => 'datepicker'
            ]])
            ->add('numberPerson', null, ['label' => 'How many ?'])
            ->add('missionType')
            ->add('level')
            ->add('planet', null, [
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
