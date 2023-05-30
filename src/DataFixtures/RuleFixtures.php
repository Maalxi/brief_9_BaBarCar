<?php

namespace App\DataFixtures;

use App\Entity\Rule;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class RuleFixtures extends AbstractFixture implements DependentFixtureInterface
{
    // La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
    // C'est cette méthode qui permet de créer des fixtures
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {

            // Instancie un objet Product avec un nom
            $rule = new Rule();

            $rule->setName($this->faker->word());
            $rule->setDescription($this->faker->sentence(10));
            $rule->setAuthor($this->getReference("user_" . $this->faker->numberBetween(1, 9)));

            $this->setReference('rule_' . $i, $rule);
            // Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($rule);
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
