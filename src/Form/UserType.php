<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Username')
            ->add('description')
            ->add('tax_registration_number')
            ->add('localisation')

            ->add('images',FileType::class,[
                'mapped'=>false,
            ])
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('numero')
            ->add('emailadresse')

            ->add('role',ChoiceType::class,[

                'required'=> true,
                'expanded' => false,
                'multiple' => false,
                'choices'=>[
                    'job seeker'=>'job seeker',
                    'company'=>'company',

                ],
                'data'=>'company',
                'label'=>'role'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
