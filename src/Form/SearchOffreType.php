<?php


namespace App\Form;


use App\Data\SearchData;
use App\Data\SearchOffreData;
use App\Entity\CategorieOffre;
use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specialite' , EntityType::class,[
                'label'=>false,
                'required' => false ,
                'expanded' => false,
                'multiple' =>false,
                'class' => CategorieOffre::class

            ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => SearchOffreData::class,
            'method'=> 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }


}