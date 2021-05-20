<?php

namespace App\DataFixtures;
use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Studio;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker= Factory::create();
        $users= [];
        for($i=0; $i<10;$i++){
            $user= new User();
            $user->setUsername($faker->name());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setRoles(['ROLE_USER']);
            $users[]=$user;
            $manager->persist($user);
        }
        $studios= [];
        for($i=0; $i<10;$i++){
            $studio= new Studio();
            $studio->setName($faker->text(10));
            $studios[]=$studio;
            $manager->persist($studio);
        }

        $genres= [];
        for($i=0; $i<10;$i++){
            $genre= new Genre();
            $genre->setName($faker->text(50));
            $genres[]=$genre;
            $manager->persist($genre);
        }
        $actors= [];
        for($i=0; $i<50;$i++){
            $actor= new Actor();
            $actor->setFirstName($faker->firstName());
            $actor->setLastName($faker->lastName());
            $actor->setImage("https://loremflickr.com/320/240?random=".$i);
            $actors[]=$actor;
            $manager->persist($actor);
        }


        $movies=[];
        for($i=0; $i<200;$i++){
            $movie= new Movie();
            $movie->setName($faker->name());
            $movie->setOriginalName($faker->name());
            $movie->setImage("https://loremflickr.com/320/240?random=".$i);
            $movie->setSeen($faker->numberBetween(0,1));
            $movie->setWatchList($faker->numberBetween(0,1));
            $movie->setSynopsis($faker->text());
            $movie->setReleaseDate($faker->dateTimeBetween('-30 years','now'));
            $random= random_int(1,5);
            for($j=0; $j<$random;$j++){
                $movie->addActor($actors[$faker->numberBetween(0,49)]);
                $movie->addGenre($genres[$faker->numberBetween(0,9)]);
                $movie->addStudio($studios[$faker->numberBetween(0,9)]);
            }
            $manager->persist($movie);
        }
        $manager->flush();
    }
}
