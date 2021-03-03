<?php

namespace App\Form;

use App\Entity\WorkReseacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReseacherAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_reseacher')
            ->add('first_name_reseacher')
            ->add('cin')
            ->add('date_of_birth')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorkReseacher::class,
        ]);
    }
}
