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

                'required'=> true,
                'expanded' => false,
                'multiple' => false,
                'choices'=>[
                    'bullying'=>'bullying',
                    'racism'=>'racism',
                    'network problems'=>'network problems',
                    'canceling the interview'=>'canceling the interview',
                    'being late'=>'being late',
                    'being rude'=>'being rude',
                ],
                'data'=>'being late',
                'label'=>'your reason'
            ])
            ->add('gsm')
            ->add('accept',
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
