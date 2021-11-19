<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Ajouter photo et videos.
        $builder
            ->add('imageFile', VichImageType::class, [
                'label'=>'Image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                //'constraints'=> [ new Image(['maxSize'=>'1M'])],
                'imagine_pattern' => 'squared_thumbnail_small',
                ])
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('groupe', TextareaType::class)
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
