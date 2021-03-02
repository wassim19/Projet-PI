<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message')
            ->add('motif',ChoiceType::class,[

                'required'=> false,
                'choices'=>[
                    'problémes de connexion'=>'problémes de connexion',
                    'retard'=>'retard',
                    'annulation de l"entretien'=>'annulation de l"entretien',
                    ''=>'',
                ],
                'label'=>'votre motif'
            ])
            ->add('gsm')
            ->add('accepter',
                CheckboxType::class,['mapped'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
