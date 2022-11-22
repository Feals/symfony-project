<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();
        $actorsCount = 10;

        for ($actorIndex = 0; $actorIndex < $actorsCount; $actorIndex++) {
            $programCount = 3;
            $programs = ProgramFixtures::PROGRAMS;
            shuffle($programs);

            $actor = new Actor();
            $actor->setName($faker->name());   
            for ($programIndex = 0; $programIndex < $programCount; $programIndex++) {
                $actor->addProgram($this->getReference("program_" . $programs[$programIndex]["title"]));
            }

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class
        ];
    }
}


   /* public const ACTORS = [
        [
            "name" => "Bruce Willis",
            "program" => "program_2", "program_1", "program_3"
        ],
        [
            "name" => "Will Smith",
            "program" => "program_2", "program_1", "program_3"
        ],
        [
            "name" => "Emma Watson",
            "program" => "program_2", "program_1", "program_3"
        ],
        [
            "name" => "Daniel Radcliff",
            "program" => "program_2", "program_1", "program_3"
        ],
        [
            "name" => "Omar Sy",
            "program" => "program_4", "program_6", "Programe_2"
        ],
        [
            "name" => "Jean Renaut",
            "program" => "program_4", "program_6", "Programe_2"
        ],
        [
            "name" => "Catherine De Neuve",
            "program" => "program_4", "program_6", "Programe_2"
        ],
        [
            "name" => "Leonardo Di Caprio",
            "program" => "program_4", "program_6", "Programe_5"
        ],
        [
            "name" => "Axel Juste",
            "program" => "program_4", "program_6", "Programe_5"
        ],
        [
            "name" => "Pauline Ledoux",
            "program" => "program_1", "program_6", "Programe_5"
        ],
        [
            "name" => "John Connery",
            "program" => "program_1", "program_6", "Programe_5"
        ],
        [
            "name" => "Arnauld Schwatzeneger",
            "program" => "program_4", "program_3", "Programe_5"
        ]];
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTORS as $index => $actorData) {
            $actor = new Actor();
            $actor->setName($actorData["name"]);
            $actor->setProgram($this->getReference($actorData["program"]));        
            $manager->persist($actor);

        $manager->flush();
    }
}



    public function getDependencies()
    {    
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
            return [
              CategoryFixtures::class,

        ];

    }
}*/