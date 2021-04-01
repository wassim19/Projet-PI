<?php


namespace App\Form;


use App\Data\SearchCV;
use App\Data\SearchData;
use App\Entity\Cv;
use App\Entity\CvTech;
use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCVType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type' , EntityType::class,[
                'label'=>false,
                'required' => true ,
                'expanded' => false,
                'multiple' =>false,
                'class' => CvTech::class

            ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => SearchCV::class,
            'method'=> 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}