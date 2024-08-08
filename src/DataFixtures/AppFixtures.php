<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $pizza = new Pizza();
        $pizza  ->setName('')
                ->setDescription('')
                ->setSize('')
                ->setCore('')
                ->setPrice(0.00)
                ->setImage('');

        $manager->persist($pizza);
        $manager->flush();
    }
}