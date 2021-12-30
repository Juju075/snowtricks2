<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentsFixtures extends Fixture
{
    public $users;
    public $tricks;

    //Accessing Services from the Fixtures.
    public function __construct(UserRepository $userRepository, TrickRepository $trickRepository){
        $this->users = $userRepository->findBy([]);
        $this->tricks = $trickRepository->findBy([]);
    }

    //referencer les tricks dans tricksfixtures
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // foreach ($users as $user) {
        //     foreach ($tricks as $trick) {
        //         if (rand(0, 1) === 1) {
        //             $comment = new Comment();
        //             $comment->setContent($faker->realText(400));
        //             $trick->addComment($comment);
        //         }
        //         $manager->persist($trick);
        //     }
        // }
        // $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TricksFixtures::class
        ];
    }
}
