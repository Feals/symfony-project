<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $episode = new Episode();
        $episode->setTitle('Les morts se réveillent');
        $episode->setNumber(1);
        $episode->setSynopsis("Episode 1.");
        $episode->setseason($this->getReference('season_1'));

        $manager->persist($episode);
        $manager->flush();
   
  
        $episode = new Episode();
        $episode->setTitle('Les morts attaquent');
        $episode->setNumber(2);
        $episode->setSynopsis("Episode 2.");
        $episode->setseason($this->getReference('season_1'));

        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle("Naissance d'un draon");
        $episode->setNumber(1);
        $episode->setSynopsis("Episode 1.");
        $episode->setseason($this->getReference('season_2'));

        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle("Mort d'un draon");
        $episode->setNumber(1);
        $episode->setSynopsis("Episode 1.");
        $episode->setseason($this->getReference('season_3'));

        $manager->persist($episode);
        $manager->flush();
    }

    public function getDependencies()
        {    
            // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
                return [
                  SeasonFixtures::class,
    
            ];
    
        }
}
