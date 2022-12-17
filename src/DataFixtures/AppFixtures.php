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
            $title = $this->faker->word(3,true);
            $article->setTitle($title)
                    ->setSlug(str_replace(' ','-',$title))
                    ->setIntroduction($this->faker->sentence(1))
                    ->setContent($this->faker->paragraphs(2,true))
                    ->setPhoto($this->faker->imageUrl(360,360,'animals',true));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
