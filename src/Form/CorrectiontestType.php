<?php

namespace App\Form;

use App\Entity\Correctiontest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CorrectiontestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reponseQ1')
            ->add('reponseQ2')
            ->add('reponseQ3')
            ->add('reponseQ4')
            ->add('reponseQ5')
            ->add('reponseQ6')
            ->add('reponseQ7')
            ->add('reponseQ8')
            ->add('reponseQ9')
            ->add('reponseQ10')
            ->add('reponseQ11')
            ->add('reponseQ12')
            ->add('reponseQ13')
            ->add('reponseQ14')
            ->add('reponseQ15')
            ->add('reponseQ16')
            ->add('reponseQ17')
            ->add('reponseQ18')
            ->add('reponseQ19')
            ->add('reponseQ20')
            ->add('note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Correctiontest::class,
        ]);
    }
}
