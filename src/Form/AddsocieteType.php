<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddsocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('namesociete')
            ->add('matriculefiscale')
            ->add('description')
            ->add('nationalite')
            ->add('adresse')
            ->add('nomad')
            ->add('prenomadd')
            ->add('cin')
            ->add('numtelad')
            ->add('datead')
            ->add('nomch')
            ->add('prenomcher')
            ->add('cincher')
            ->add('ntelcher')
            ->add('localisation')
            ->add('adressecher')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
