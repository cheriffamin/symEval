<?php

namespace App\DataFixtures;

use App\Entity\Questions;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;




class QuestionFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(Users::class)->findAll();
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $question = new Questions();
            $question->setContent($faker->text);
            $question->setTitle($faker->text);
            $question->setUser($faker->randomElement($users));
            $manager->persist($question);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
        );
    }
}
