<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixture
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures
        public function load(ObjectManager $manager)
        {
          
          $adminUser = new User();
          $adminUser->setEmail('admin@gmail.com');
          $adminUser->setPassword('$2y$13$wOzhA4glxuhEELj91ChCF.t.P8fzLM9iah2MK9xEExUzkkYcfdjOq');
          $adminUser->setRoles([]);
          $adminUser->setFirstName($this->faker->firstName());
          $adminUser->setLastName($this->faker->lastName());
          
          $dateString = $this->faker->date();
          $createdDate = new \DateTime($dateString);
          
          $adminUser->setCreated($createdDate);
          
          
          $phoneNumber = $this->faker->phoneNumber();
          $adminUser->setPhone(intval($phoneNumber));

          $manager->persist($adminUser);
  
          $this->setReference('user_' . 0, $adminUser);

          for ($i = 1; $i < 10; $i++) {
      
            // Instancie un objet Product avec un nom
            $user = new User();
      
            $user->setEmail($this->faker->email());
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345678'));
            $user->setRoles([]);
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
      
            $dateString = $this->faker->date();
            $createdDate = new \DateTime($dateString);
      
            $user->setCreated($createdDate);
      
      
            $phoneNumber = $this->faker->phoneNumber();
            $user->setPhone(intval($phoneNumber));
      
      
            // Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($user);

            $this->setReference('user_' . $i, $user);
          }
      
          // Une fois la boucle terminée je persiste les produits fraîchement créés
          $manager->flush();
        }
      }