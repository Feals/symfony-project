<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d'hommes et de femmes mené par l'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.");
        $season->setProgram($this->getReference('program_0'));
        $this->addReference('season_1', $season);

        $manager->persist($season);
        
        $manager->flush();
   
  
        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2011);
        $season->setDescription("Mother of dragons.");
        $season->setProgram($this->getReference('program_1'));
        $this->addReference('season_2', $season);

        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(2);
        $season->setYear(2012);
        $season->setDescription("Mother of dragons the return.");
        $season->setProgram($this->getReference('program_1'));
        $this->addReference('season_3', $season);

        $manager->persist($season);
        $manager->flush();
        
    }

    public function getDependencies()
        {    
            // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
                return [
                  ProgramFixtures::class,
    
            ];
    
        }
}
