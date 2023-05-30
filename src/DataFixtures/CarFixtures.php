<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CarFixtures extends AbstractFixture implements DependentFixtureInterface
{
        // La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
        // C'est cette méthode qui permet de créer des fixtures
        public function load(ObjectManager $manager)
        {
          // Une boucle de 10 pour générer 10 produits
          for ($i = 1; $i < 6; $i++) {
      
            // Instancie un objet Product avec un nom
            $car = new Car();
      
            $car->setBrand($this->faker->word());
            $car->setModel($this->faker->word());
            $car->setSeats($this->faker->numberBetween(1,4));
            $car->setOwner($this->getReference("user_" . $this->faker->numberBetween(1, 5)));
            $dateString = $this->faker->date();
            $createdDate = new \DateTime($dateString);
      
            $car->setCreated($createdDate);
      
      
            // Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($car);
          }
      
          // Une fois la boucle terminée je persiste les produits fraîchement créés
          $manager->flush();
        }
        public function getDependencies()
    {
        return [
                        UserFixtures::class,
                ];
    }
      }