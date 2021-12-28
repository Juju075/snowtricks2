<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Video;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TricksFixtures extends Fixture implements DependentFixtureInterface
{
    // Relations de Trick::class (target fk) - user comments photos videos category
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($nbTricks=1; $nbTricks <= 40 ; $nbTricks++) { 
            //pour un utilisateur en reference de facon aleatoire reuse user_id
            $user = $this->getReference('user_'. $faker->numberBetween(1 ,10));
            $category = $this->getReference('category_'. $faker->numberBetween(1 ,1));

            $trick = new Trick();
            $trick->setuser($user);
            $trick->setCategory($category);
            $trick->setNom($faker->realText(25));
            $trick->setDescription($faker->realText(400));

            //upload photos 3 img par trick
            for ($nbimage=0; $nbimage <= 2 ; $nbimage++) { 
                //genere une nouvelle image a chaque boucle
                //$photo = $faker->image('public/uploads/'); //image() path de destination , taille et random. vu pas d'extension!!!
                
                //$photoName = str_replace('public/uploads\\', '', $photo);
                //$photoName = basename($photo);

                $photoName = array(
                    '1'=>'3a2efcb1dd5be46ad242348d1155470d.jpg',
                    '2'=>'0508f7e1f32150aaf16b4545a7438fcc.jpg',
                    '3'=>'b522c2816511c322fd450185b8fcc7ce.jpg',
                    '4'=>'4ccc18a0d10cd25d778ec2eba1ec9a82.jpg',
                    '5'=>'a252a944f109d4a87de24fadbf2b3173.jpg',
                    '6'=>'a7fe1d19ba3580ad8f6acc3272659e0d.jpg',
                    '7'=>'72905b91613379722cecaac74f67e982.jpg',
                    '8'=>'92af130caab728520c70853bc35d84aa.jpg',
                    '9'=>'449360a6bf7581c30247140e30e255ab.jpg',
                    '10'=>'a81eb2a5105a43366421cc7d3e3cf870.jpg',
                    '11'=>'8b58d78fc1d28fc5b446b3dd78379ff0.jpg',
                    '12'=>'dcbb0da03b5840d6574abf507b58550a.jpg',
                    '13'=>'f20ad0211ab29ad8d29b899573604c22.jpg',
                    '14'=>'99b47532cf17093c95e84c6e3ff7d2c3.jpg',
                    '15'=>'4ae9be30a99889f9d4b7769f100e6a63.jpg'
                );
                shuffle($photoName); 
                $photoTrick = new Photo();
                $photoTrick->setName($photoName[0]);
                $trick->addPhoto($photoTrick);
            }
            
            //upload embedded 3 par trick
            for ($nbembedded=0; $nbembedded <= 2 ; $nbembedded++) { 
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
            //nb pour numerotion
            $this->addReference('trick_'. $nbTricks, $user); 
            $manager->persist($trick);
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
