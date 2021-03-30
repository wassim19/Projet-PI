<?php

namespace App\Form;

use App\Entity\Cv;

use App\Entity\CvTech;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormTypeInterface;


class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('photo',FileType::class,[
                    'mapped'=>false,
                    'required'=>false
            ])

            ->add('categoryType',EntityType::class,['class'=>CvTech::class,'choice_label'=>'category'])
            ->add('description')
            ->add('name')
            ->add('adresse')
            ->add('phone')
            ->add('mail')
            ->add('pro1_titre',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"professional title1"
            ])
            ->add('pro1_socie',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"Company"
            ])
            ->add('pro1_date_debut',ChoiceType::class,[


                'label'=>"starts",

        'required'=> true,

        'choices'=>[
            'from'=>'',
            '1990'=>'1990',
            '1991'=>'1991',
            '1992'=>'1992',
            '1993'=>'1993',
            '1994'=>'1994',
            '1995'=>'1995',
            '1996'=>'1996',
            '1997'=>'1997',
            '1998'=>'1998',
            '1999'=>'1999',
            '2000'=>'2000',
            '2001'=>'2001',
            '2002'=>'2002',
            '2003'=>'2003',
            '2004'=>'2004',
            '2005'=>'2005',
            '2006'=>'2006',
            '2007'=>'2007',
            '2008'=>'2008',
            '2009'=>'2009',
            '2010'=>'2010',
            '2011'=>'2011',
            '2012'=>'2012',
            '2013'=>'2013',
            '2014'=>'2014',
            '2015'=>'2015',
            '2016'=>'2016',
            '2017'=>'2017',
            '2018'=>'2018',
            '2019'=>'2019',
            '2020'=>'2020',
            '2021'=>'2021',


        ],


    ])
            ->add('pro1_date_fin',ChoiceType::class,[

                'label'=>"ends",
                'required'=> true,

                'choices'=>[
                    'to'=>'',
                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],


            ])
            ->add('etabl',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"educational institution"
            ])
            ->add('etabl_type',ChoiceType::class,[
                'label'=>"educational institution type",
                'choices'=>[
                    'select your degree'=>null,
                    'high school'=>'high school',
                    'university'=>'university',
                ]
            ])
            ->add('etab_date_debut',ChoiceType::class,[

                'label'=>"starts",
                'required'=> true,

                'choices'=>[

                    'from'=>'',
                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('etab_date_fin',ChoiceType::class,[

                'label'=>"ends",
                'required'=> true,

                'choices'=>[

                    'to'=>'',
                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],


            ])
            ->add('skill_pro1',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"professional skill"
            ])
            ->add('skill_pro1_data',ChoiceType::class,[
                 'required'=> true,
                'label'=>"professional skill level",
                'choices'=>[
                    'select your level'=>'',
                    'Introductory level'=>'Introductory level',
                    'Intermediate level'=>'Intermediate level',

                    'Advanced level'=>'Advanced level',

                    'Proficiency level'=>' Proficiency level',
                ],

            ])
            ->add('skill_perso1',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"personnel skill"
            ])
            ->add('skill_perso1_data',ChoiceType::class,[
                'label'=>"personnel skill level",
                'choices'=>[
                    'your level'=>'',
                    '10%'=>'10',
                    '20%'=>'20',
                    '30%'=>'30',
                    '40%'=>'40',
                    '50%'=>'50',
                    '60%'=>'60',
                    '70%'=>'70',
                    '80%'=>'80',
                    '90%'=>'90',

                ],

            ])
            ->add('interest1')
            ->add('lang1',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"language1"
            ])
            ->add('lang1_data',ChoiceType::class,[
                'required'=> true,
                'label'=>"language1 level",
                'choices'=>[
                    'select your level'=>'',
                    'A1 - Introductory level'=>'A1 - Introductory level',
                    'A2 - Intermediate level'=>'A2 - Intermediate level',
                    'B1 - Threshold level'=>'B1 - Threshold level',
                    'B2 - Advanced level'=>'B2 - Advanced level',
                    'C1 - Autonomous level'=>'C1 - Autonomous level',
                    'C2 - Proficiency level'=>'C2 - Proficiency level',
                ],

            ])
            ->add('pro2_titre',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"professional title2"
            ])
            ->add('pro2_socie',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"Company"
            ])
            ->add('pro2_date_debut',ChoiceType::class,[

                'label'=>"starts",
                'required'=> true,

                'choices'=>[
                    'from'=>'',

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('pro2_date_fin',ChoiceType::class,[

                'label'=>"ends",
                'required'=> true,

                'choices'=>[
                    'to'=>'',

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],



            ])
            ->add('etabl2',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"educational institution"
            ])
            ->add('etabl2_type',ChoiceType::class,[
                'label'=>"educational institution",
                'choices'=>[
                    'select your degree'=>null,
                    'high school'=>'high school',
                    'university'=>'university',
                ]
            ])
            ->add('etab2_date_debut',ChoiceType::class,[

                'label'=>"starts",
                'required'=> true,

                'choices'=>[
                    'from'=>'',

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('etab2_date_fin',ChoiceType::class,[
                'label'=>"ends",

                'required'=> true,

                'choices'=>[
                    'to'=>'',

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],



            ])
            ->add('skill_pro2',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"professional skill"
            ])
            ->add('skill_pro2_data',ChoiceType::class,[
                'required'=> true,
                'label'=>"professional skill level",
                'choices'=>[
                    'select your level'=>'',
                    'Introductory level'=>'Introductory level',
                    'Intermediate level'=>'Intermediate level',

                    'Advanced level'=>'Advanced level',

                    'Proficiency level'=>'Proficiency level',
                ],

            ])
            ->add('skill_perso2',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"personnel skill"
            ])
            ->add('skill_perso2_data',ChoiceType::class,[
                'label'=>"personnel skill",
                'choices'=>[
                    'your level'=>'',
                    '10%'=>'10',
                    '20%'=>'20',
                    '30%'=>'30',
                    '40%'=>'40',
                    '50%'=>'50',
                    '60%'=>'60',
                    '70%'=>'70',
                    '80%'=>'80',
                    '90%'=>'90',

                ],

            ])
            ->add('interest2')
            ->add('lang2',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=>"language2"
            ])
            ->add('lang2_data',ChoiceType::class,[
                'required'=> true,
                'label'=>"language2",
                'choices'=>[
                    'select your level'=>'',
                    'A1 - Introductory level'=>'A1 - Introductory level',
                    'A2 - Intermediate level'=>'A2 - Intermediate level',
                    'B1 - Threshold level'=>'B1 - Threshold level',
                    'B2 - Advanced level'=>'B2 - Advanced level',
                    'C1 - Autonomous level'=>'C1 - Autonomous level',
                    'C2 - Proficiency level'=>'C2 - Proficiency level',
                ],


            ])
            ->add('pro3_titre')
            ->add('pro3_socie')
            ->add('pro3_date_debut',ChoiceType::class,[




                'choices'=>[
                    'from'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],


            ])
            ->add('pro3_date_fin',ChoiceType::class,[




                'choices'=>[

                    'to'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],



            ])
            ->add('etabl3')
            ->add('etabl3_type',ChoiceType::class,[

                'choices'=>[
                    'select your degree'=>null,

                    'high school'=>'high school',
                    'university'=>'university',
                ],

            ])
            ->add('etab3_date_debut',ChoiceType::class,[


                'required'=> true,

                'choices'=>[
                    'from'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('etab3_date_fin',ChoiceType::class,[


                'required'=> true,

                'choices'=>[

                    'to'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],


            ])
            ->add('skill_pro3')
            ->add('skill_pro3_data',ChoiceType::class,[


                'choices'=>[
                    'select your level'=>null,
                    'Introductory level'=>'Introductory level',
                    'Intermediate level'=>'Intermediate level',

                    'Advanced level'=>'Advanced level',

                    'Proficiency level'=>'Proficiency level',
                ],

            ])
            ->add('skill_perso3')
            ->add('skill_perso3_data',ChoiceType::class,[

                'choices'=>[
                    'your level'=>null,
                    '10%'=>'10',
                    '20%'=>'20',
                    '30%'=>'30',
                    '40%'=>'40',
                    '50%'=>'50',
                    '60%'=>'60',
                    '70%'=>'70',
                    '80%'=>'80',
                    '90%'=>'90',

                ],

            ])
            ->add('interest3')
            ->add('lang3')
            ->add('lang3_data',ChoiceType::class,[


                'choices'=>[
                    'select your level'=>null,
                    'A1 - Introductory level'=>'A1 - Introductory level',
                    'A2 - Intermediate level'=>'A2 - Intermediate level',
                    'B1 - Threshold level'=>'B1 - Threshold level',
                    'B2 - Advanced level'=>'B2 - Advanced level',
                    'C1 - Autonomous level'=>'C1 - Autonomous level',
                    'C2 - Proficiency level'=>'C2 - Proficiency level',
                ],

            ])
            ->add('pro4_titre')
            ->add('pro4_socie')
            ->add('pro4_date_debut',ChoiceType::class,[




                'choices'=>[
                    'from'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('pro4_date_fin',ChoiceType::class,[




                'choices'=>[

                    'to'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],



            ])
            ->add('etabl4')
            ->add('etabl4_type',ChoiceType::class,[

                'choices'=>[
                    'select your degree'=>null,
                    'high school'=>'high school',
                    'university'=>'university',
                ],

            ])
            ->add('etab4_date_debut',ChoiceType::class,[




                'choices'=>[

                    'from'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',


                ],



            ])
            ->add('etab4_date_fin',ChoiceType::class,[




                'choices'=>[

                    'to'=>null,

                    '1990'=>'1990',
                    '1991'=>'1991',
                    '1992'=>'1992',
                    '1993'=>'1993',
                    '1994'=>'1994',
                    '1995'=>'1995',
                    '1996'=>'1996',
                    '1997'=>'1997',
                    '1998'=>'1998',
                    '1999'=>'1999',
                    '2000'=>'2000',
                    '2001'=>'2001',
                    '2002'=>'2002',
                    '2003'=>'2003',
                    '2004'=>'2004',
                    '2005'=>'2005',
                    '2006'=>'2006',
                    '2007'=>'2007',
                    '2008'=>'2008',
                    '2009'=>'2009',
                    '2010'=>'2010',
                    '2011'=>'2011',
                    '2012'=>'2012',
                    '2013'=>'2013',
                    '2014'=>'2014',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    'today'=>'today',

                ],



            ])
            ->add('skill_pro4')
            ->add('skill_pro4_data',ChoiceType::class,[


                'choices'=>[
                    'select your level'=>null,
                    'Introductory level'=>'Introductory level',
                    'Intermediate level'=>'Intermediate level',

                    'Advanced level'=>'Advanced level',

                    'Proficiency level'=>'Proficiency level',
                ],

            ])
            ->add('skill_perso4')
            ->add('skill_perso4_data',ChoiceType::class,[

                'choices'=>[
                    'your level'=>null,
                    '10%'=>'10',
                    '20%'=>'20',
                    '30%'=>'30',
                    '40%'=>'40',
                    '50%'=>'50',
                    '60%'=>'60',
                    '70%'=>'70',
                    '80%'=>'80',
                    '90%'=>'90',

                ],

            ])
            ->add('interest4')
            ->add('lang4')
            ->add('lang4_data',ChoiceType::class,[


                'choices'=>[
                    'select your level'=>null,
                    'A1 - Introductory level'=>'A1 - Introductory level',
                    'A2 - Intermediate level'=>'A2 - Intermediate level',
                    'B1 - Threshold level'=>'B1 - Threshold level',
                    'B2 - Advanced level'=>'B2 - Advanced level',
                    'C1 - Autonomous level'=>'C1 - Autonomous level',
                    'C2 - Proficiency level'=>'C2 - Proficiency level',
                ],


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
    public function  compaire(String $a,String $b){
        $off=false;
        if (strcmp($a,$b)<=0){
            $off=true;
        }else{
            $off=false;
        }

    }
}
