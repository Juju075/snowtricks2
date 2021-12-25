<?php

namespace App\DataFixtures;

use App\Entity\Category;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //1- Déclarer la variable category avec #choix de category. 8:35
        $category =[
            1 => [
                'nom' => 'Embase',
                'slug' => 'embase',
            ]
        ];

        //2-Pour chaque element de category listé on crée une instance de l'entité Category.
        foreach($category as $key =>$value){
            $category = new Category();
            $category->setNom($value['nom']);
            $category->setSlug($value['slug']);
            $manager->persist($category);

            //3- Ajoute une refernece
            //Enregistrer la category dans une réference. eg: category_1 Category::class id
            $this->addReference('category_'. $key, $category);
        }

        //3- Grace au model de persistence ObjectManager
        $manager->flush();

    }
}
