<?php

namespace App\DataFixtures;

use App\Entity\Answers;
use App\Entity\Questions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;




class AnswerFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $questions = $manager->getRepository(Questions::class)->findAll();
        $faker = Faker\Factory::create('fr_FR');
        
        for ($i = 0; $i < 20; $i++) {
            $answer = new Answers();
            $answer->setContent($faker->text);
            $answer->setStatus($faker->boolean);
            $answer->setQuestion($faker->randomElement($questions));
            $manager->persist($answer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            QuestionFixture::class,
        );
    }
}
