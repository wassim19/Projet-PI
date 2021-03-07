<?php

namespace App\Form;

use App\Entity\CategorieOffre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specialite')
            ->add('nb_dem')
            ->add('description')
            ->add('localisation')
            ->add('typecategorie',EntityType::class,['class'=>CategorieOffre::class,'choice_label'=>'type'])
            ->add('imagesoffre',FileType::class,[
                'mapped'=>false,
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
