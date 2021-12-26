<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;


use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TricksFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // Relations de Trick::class (target fk) - user comments photos videos category

        //Pour la creation d'un trick
        for ($nbTricks=1; $nbTricks <= 40 ; $nbTricks++) { 
            //pour un utilisateur en reference de facon aleatoire reuse user_id
            $user = $this->getReference('user_'. $faker->numberBetween(1 ,10));
            $category = $this->getReference('category_'. $faker->numberBetween(1 ,1));

            $trick = new Trick();
            $trick->setuser($user);
            $trick->setCategory($category);
            $trick->setNom($faker->realText(25));
            $trick->setDescription($faker->realText(400));

            //Inputs de Fichiers.

            //upload photos 4 img par trick
            for ($image=0; $image <= 3 ; $image++) { 
                $photo = $faker->image('public/uploads/'); // path de destination , taille et random.
                $photoTrick = new Photo();
                //permet d'enlever le path et garder juste le name de la photo 47:08
                $photoTrick->setName(str_replace('photos_pick/', '', $photo));
                $trick->addPhoto($photoTrick);
            }
            
            //upload embedded 2 par trick
            for ($embedded=0; $embedded <= 3 ; $embedded++) { 
                //$embedded = $faker->realText(); 
                $listOfEmbedded = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
                $embedded = array_rand($listOfEmbedded, 1); //php random string from list
                
                $videoTrick = new Video();
                $videoTrick->setEmbedded($embedded); //location liste
                $trick->addVideo($videoTrick);
            }

            $manager->persist($trick);
        }
        $manager->flush();

        //appel function  addRandomComments()
    }

    public function addRandomComments()
    {
        //une fois que tous les tricks existe on vas les commentes.
        //passe en revue chaque trick ajoute un commentaire.
        //passe en revue tous les utilisateurs poste un comment oui ou non
    }

    //liste les dependences de la Fixture TricksFixtures get references
    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
            UsersFixtures::class
        ];
    }
}
