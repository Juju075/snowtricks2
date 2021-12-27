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

            //upload photos 3 img par trick
            for ($image=0; $image <= 2 ; $image++) { 
                //genere une nouvelle image a chaque boucle
                $photo = $faker->image('public/uploads');
                $photoName = basename($photo);

                $photoTrick = new Photo();
                //$photoTrick->setName(array_rand($listOfImages));
                $photoTrick->setName($photoName);
                $trick->addPhoto($photoTrick);
            }
            
            //upload embedded 3 par trick
            for ($embedded=0; $embedded <= 2 ; $embedded++) { 
                $embedded = array(
                    '1'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    '2'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    '3'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    '4'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    '5'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    '6'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/V9xuy-rVj9w?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
                );
                shuffle($embedded);    

                $videoTrick = new Video();
                $videoTrick->setEmbedded($embedded[0]); //location liste
                $trick->addVideo($videoTrick);
            }

            $manager->persist($trick);

        }
        $manager->flush();
        $this->addRandomComments();
    }

    public function addRandomComments(User $user, Trick $tricks, ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        //connecte un utilisateur
        foreach ($user as $value) {
            dd($user);
            //pour chaque tricks lu
            foreach ($tricks as $value) {
    
                if (rand(0, 1) === 1) {
                    $comment = new Comment();
                    $comment->setContent($faker->realText(400));
                    $tricks->addComment($comment);
                }
                $manager->persist($tricks);
            }
        }
        $manager->flush();
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
