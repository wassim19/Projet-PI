<?php


namespace App\Form;
use App\Entity\CvImported;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CvImportedType extends AbstractType


{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('filename', FileType::class, [


                'mapped'=>false,
                'required'=>false
            ]);


    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CvImported::class,
        ]);
    }

}