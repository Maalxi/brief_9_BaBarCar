<?php

namespace App\DataFixtures;

use App\Entity\AnimalSex;
use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends AbstractFixture
{
    public const REF_USER = self::class;


    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@gmail.com');
        $adminUser->setRoles([]);
        
        // $adminUser->setVerified(1);
        
        $adminUser->setPassword('$2y$13$YWUuFI7lRCxOmMI7xSlMd.6TGuTcMtXzRfp8KhjvhSytNiJA1CJ3a');
        
        $adminUser->setFirstName($this->faker->firstName());
        $adminUser->setLastName($this->faker->lastName());

        $adminUser->setPhone($this->faker->phoneNumber());

        $dateString = $this->faker->date(); // Example date string
        $createdDate = new \DateTime($dateString); // Convert the string to a DateTime object
        
        $adminUser->setCreated($createdDate);

        $manager->persist($adminUser);

        $this->setReference(self::REF_USER . '_' . 0, $adminUser);

        for ($i = 1; $i < 6; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setRoles([]);

            // $user->setVerified(1);

            $user->setPassword($this->passwordHasher->hashPassword($user, '12345678'));

            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
    
            $user->setPhone($this->faker->phoneNumber());
    
            $dateString = $this->faker->date(); // Example date string
            $createdDate = new \DateTime($dateString); // Convert the string to a DateTime object
            
            $user->setCreated($createdDate);

            $manager->persist($user);

            $this->setReference('user_' . $i, $user);
        }

        $manager->flush();
    }
}