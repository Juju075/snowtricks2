<?php
declare(strict_types=1);
namespace App\DataFixtures;
 
 
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UsersFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;


    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder){
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // $users =[]; // declaration

        // Create 10 users.
        for ($nbUsers=1; $nbUsers < 10; $nbUsers++) { 
            $user = new User();
            $user->setEmail($faker->email);
            //1 role Admin les autres utilisateur
            if ($user === 1) {
                $user->setRoles(['ROLE_ADMIN']);
            }else{
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->userPasswordEncoder->encodePassword($user, "identique"));
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName);
                $user->setIsVerified($faker->numberBetween(0, 1));
                
                $this->addReference('user_'. $nbUsers, $user); //user1
                
                $manager->persist($user);
                // $users[] = $user // ajoute l'utilisateur fraichement creer apres persist.
                //reference le tableau des utilisateurs.
            }

            $manager->flush();
        }
    }
}