<?php

namespace App\DataFixtures;

use App\Entity\Ride;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class RideFixtures extends AbstractFixture implements DependentFixtureInterface
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures
        public function load(ObjectManager $manager)
        {
          for ($i = 1; $i < 10; $i++) {
      
            // Instancie un objet Product avec un nom
            $ride = new Ride();
      
            $ride->setDeparture($this->faker->city());
            $ride->setDestination($this->faker->city());
            $ride->setSeats($this->faker->numberBetween(0,4));
            $ride->setPrice($this->faker->numberBetween(1,50));
            $ride->setDate($this->faker->dateTimeThisMonth());
            $ride->setDriver($this->getReference("user_" . $this->faker->numberBetween(1, 9)));
            $ride->addRule($this->getReference("rule_" . $this->faker->numberBetween(1, 9)));
            $dateString = $this->faker->date();
            $createdDate = new \DateTime($dateString);
      
            $ride->setCreated($createdDate);
      
            $this->setReference('ride_' . $i, $ride);

            // Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($ride);
          }
      
          // Une fois la boucle terminée je persiste les produits fraîchement créés
          $manager->flush();
        }
        
        public function getDependencies()
        {
            return [
                UserFixtures::class,
                RuleFixtures::class,
            ];
        }
    
      }
      