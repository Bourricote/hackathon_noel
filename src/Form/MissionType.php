<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Planet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('transport')
            ->add('departureDate')
            ->add('returnDate')
            ->add('numberPerson')
            ->add('missionType')
            ->add('level')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('planet', null,[
                'choice_label' => 'name'
            ])
            ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
