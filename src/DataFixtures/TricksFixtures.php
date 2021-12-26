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

        //Mettre en boucle pour generer des imgs di
        //permet d'enlever le path et garder juste le name de la photo 47:08
        $photo = $faker->image('public/uploads/'); // path de destination , taille et random. vu pas d'extension!!!
        $photoName = str_replace('public/uploads\\', '', $photo);


        //liste de nom de photos
        $listOfImages = array(
            '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg',
            '4ae9be30a99889f9d4b7769f100e6a63.jpg',
            '99b47532cf17093c95e84c6e3ff7d2c3.jpg',
            'a252a944f109d4a87de24fadbf2b3173.jpg',
            'a7fe1d19ba3580ad8f6acc3272659e0d.jpg',
            '72905b91613379722cecaac74f67e982.jpg',
            'f20ad0211ab29ad8d29b899573604c22.jpg',
            '92af130caab728520c70853bc35d84aa.jpg',
            '449360a6bf7581c30247140e30e255ab.jpg',
            'a81eb2a5105a43366421cc7d3e3cf870.jpg',
            '8b58d78fc1d28fc5b446b3dd78379ff0.jpg',
            'dcbb0da03b5840d6574abf507b58550a.jpg'
        );


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
                //genere une nouvelle image a chaque boucle

                $photoTrick = new Photo();
                $photoTrick->setName(array_rand($listOfImages));
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
                //Fin
            //Fin
        //Fin
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
