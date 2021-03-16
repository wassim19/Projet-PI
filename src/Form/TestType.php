<?php

namespace App\Form;

use App\Entity\Surfer;
use App\Entity\Test;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('mail',EntityType::class,['class'=>Surfer::class,'choice_label'=>'emailadress'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
