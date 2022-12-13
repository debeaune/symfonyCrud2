<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct() 
    {
        $this->faker = Factory::create('fr FR');
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<=10; $i++){
            $article = new Article();
            $article->setSlug($this->faker->slug)
                    ->setIntroduction($this->faker->sentence(1))
                    ->setContent($this->faker->paragraphs())
                    ->setPhoto($this->faker->image(null,360,360));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
