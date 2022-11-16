<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
        public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
 
        $program = new Program();
        $program->setTitle('Game of thrones');
        $program->setSynopsis('Du feu et de la Glace');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Supernatural');
        $program->setSynopsis('2 Frères chassant des êtres surnaturels');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Breaking Bad');
        $program->setSynopsis('on fabrique de la meth');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('NoGame NoLife');
        $program->setSynopsis('Un monde où tous ce règle par le jeu');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
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
