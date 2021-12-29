<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Entity\Comment;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentsFixtures extends Fixture
{

    // public function __construct(User $user, TrickRepository $trickRepository){
    //         //all id user   all id tricks
    // }

    //referencer les tricks dans tricksfixtures
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tricks = null;
        //utiliser reference ou repository{id}
        //$user = $this->getReference($name);
        
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
