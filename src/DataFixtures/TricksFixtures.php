<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Comment;
use App\Entity\Video;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TricksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // Relations de Trick::class (target fk) - user comments photos videos category

        for ($nbTricks=1; $nbTricks <= 40 ; $nbTricks++) { 
            //pour un utilisateur en reference de facon aleatoire reuse user_id
            $user = $this->getReference('user_'. $faker->numberBetween(1 ,10));
            $category = $this->getReference('category_'. $faker->numberBetween(1 ,1));

            $trick = new Trick();
            $trick->setuser($user);
            $trick->setCategory($category);
            $trick->setNom($faker->realText(25));
            $trick->setDescription($faker->reaText(400));

            //upload photos 4 img par trick
            for ($image=0; $image <= 5 ; $image++) { 
                //prend une image au hassard
                $img = $faker->image('public/uploads');
                //mettre name image ds bdd

                $imageTrick = new Image();
            }
            //upload embedded

            $this->addReference();

        }

    }
}
