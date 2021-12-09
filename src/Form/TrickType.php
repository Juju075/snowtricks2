<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Ajouter photo et videos.
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, ['class'=>Category::class, 'choice_label'=>'nom'])

            //ajouter user_id cham
            //champs image
            //non mappe par la bdd (mapped a false)
             ->add('images', FileType::class,[
            'label'=>false, 
            'multiple'=>true,
            'mapped'=>false,
            'required'=>false
            ])   

            //https://www.npmjs.com/package/symfony-collection-js
            ->add('images', CollectionType::class,[
            'type'=>PhotoType::class, 
            'allow_add'=> true, 
            'allow_delete'=> true, 
            'prototype'=> true,
            'by_reference'=> false, 
            ])  

             ->add('videos', FileType::class,[
            'label'=>false, 
            'multiple'=>true,
            'mapped'=>false,
            'required'=>false
            ])           
        ;
    }

    //Utilise l'entity pour recuperer les variables class entité associé.
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }

}
 