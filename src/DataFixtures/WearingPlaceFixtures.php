<?php


namespace App\DataFixtures;


use App\Entity\WearingPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WearingPlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loactions = [
            'main hand', 'off hand', 'both hands', 'head', 'chest', 'hands', 'legs', 'feet', 'backpack'
        ];

        foreach ($loactions as $loaction){
            $fixture = new WearingPlace();
            $fixture->setLocation($loaction);
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}