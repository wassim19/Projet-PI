<?php

namespace App\Form;

use App\Entity\Correctiontest;
use App\Entity\Surfer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CorrectiontestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('mail',EntityType::class,['class'=>Surfer::class,'choice_label'=>'emailadress'])
            ->add('reponseQ1',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ2',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ3',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ4',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ5',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ6',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ7',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ8',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ9',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ10',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ11',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ12',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ13',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ14',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ15',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ16',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ17',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ18',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ19',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])
            ->add('reponseQ20',TextType::class, [
                'attr' => [
                    'placeholder' => "Write 'a' or 'b' or 'c' or 'd'"
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Correctiontest::class,
        ]);
    }
}
