<?php

namespace App\Form;

use App\Entity\Trick;
use App\Form\PhotoType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Ajouter photo et videos.
        $builder
            ->add('nom', TextType::class,[
                'constraints'=> new NotBlank([
                'message'=>'Please enter the title.'
                ])])

            ->add('description', TextareaType::class, [
                'constraints'=> new NotBlank([
                'message'=>'Please enter the description.'
                ]),
                'constraints'=> new Length([
                    'min'=>100
                ])
            ])

            ->add('category', EntityType::class, ['class'=>Category::class, 'choice_label'=>'nom'])

            ->add('photos', CollectionType::class,[
                'entry_type'=>PhotoType::class,
                'entry_options'=> ['label'=>false],
                'allow_add'=> true, 
                'allow_delete'=> true, 
                'by_reference'=> false //ne vas pas chercher un set() mais un add()
            ])

            ->add('videos',CollectionType::class, [
                'entry_type'=>VideoType::class,
                'entry_options'=> ['label'=>false],
                'allow_add'=> true, 
                'allow_delete'=> true, 
                'by_reference'=> false
            ])  
         ;
    }

    //Utilise l'entity pour recuperer les variables class entit?? associ??.
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
