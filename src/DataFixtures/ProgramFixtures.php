<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            "title" => "Walking dead",
            "synopsis" => "Des zombies envahissent la terre",
            "poster" => "",
            "category" => "category_Action"
        ],
        [
            "title" => 'Game of thrones',
            "synopsis" => 'Du feu et de la Glace',
            "poster" => "",
            "category" => "category_Fantastique"
        ],
        [
            "title" => "Supernatural",
            "synopsis" => '2 Frères chassant des êtres surnaturels',
            "poster" => "",
            "category" => "category_Horreur"
        ],
        [
            "title" => "Breaking Bad",
            "synopsis" => "on fabrique de la meth",
            "poster" => "",
            "category" => "category_Action"
        ],
        [
            "title" => "Le Destin des Wings",
            "synopsis" => "Avec des Fées",
            "poster" => "",
            "category" => "category_Action"
        ],
        [
            "title" => "NoGame NoLife",
            "synopsis" => "Un monde où tous ce règle par le jeu",
            "poster" => "",
            "category" => "category_Animation"
        ]
    ];
        public function load(ObjectManager $manager): void
    { foreach (self::PROGRAMS as $programData) {
        $program = new Program();
        $program->setTitle($programData["title"]);
        $program->setSynopsis($programData["synopsis"]);
        $program->setPoster($programData["poster"]);
        $program->setCategory($this->getReference($programData["category"]));
        $this->addReference('program_' . $programData["title"], $program);
        $manager->persist($program);
        
    }
    $manager->flush();

    
    }

        public function getDependencies()
        {    
            // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
                return [
                  CategoryFixtures::class,
    
            ];
    
        }
    
}
