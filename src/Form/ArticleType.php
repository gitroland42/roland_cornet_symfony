<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleType extends AbstractType
{





    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
            'label'=>'Titre article ',
            'attr'=>[
            'class'=>'form-control']
             ])
            ->add('description',TextareaType::class,[
            'label'=>'Description ',
            'attr'=>[
                'class'=>'form-control']
            ])
            ->add('image', FileType::class, [
                'label' => 'image (jpg file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new Image([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Fichier au format png ou jpeg',
                    ])
                ]
            ])

            // ->add('valider', SubmitType::class,
            //     ['attr' => [        
            //         'class' => 'btn' 
            //         ]
            //     ])

                ->add('valider',SubmitType::class,[
                    'attr'=> [
                        'class'=>'btn btn-info rounded d-flex  mt-3 mb-2'
                    ]
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
