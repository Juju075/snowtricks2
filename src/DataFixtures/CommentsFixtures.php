<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentsFixtures extends Fixture
{

    //referencer les tricks dans tricksfixtures
    public function load(ObjectManager $manager): void
    {
        //utiliser reference retrive user trick
        
        $faker = Faker\Factory::create('fr_FR');
        //   $tricks
        
        foreach ($user as $value) {
            //recupere utilisateur du debut a la fin.
            $user = null;
            
            //pour chaque tricks lu
            foreach ($trick as $value) {
                //recupere utilisateur du debut a la fin.
                $trick = null;
    
                if (rand(0, 1) === 1) {
                    $comment = new Comment();
                    $comment->setContent($faker->realText(400));
                    $trick->addComment($comment);
                }
                $manager->persist($trick);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TricksFixtures::class
        ];
    }
}
