<?php
declare(strict_types=1);
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
    }


    protected function loadData(ObjectManager $manager):void
    {
        $faker = Faker\Factory::create('fr_FR');

        $this->createMany(Comment::class, 100, function(Comment $comment) {
            $comment->setContent(
                $this->faker->boolean ? $this->faker->paragraph : $this->faker->sentences(2, true)
            );

            //auteur
            //$comment->setAuthorName($this->faker->name);

            $comment->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'));
            $comment->setTrick($this->getReference(Trick::class.'_0'));
        });
        $manager->flush();
    }
    

    public function getDependencies()
    {
        return [
            TricksFixtures::class
        ];
    }
}
