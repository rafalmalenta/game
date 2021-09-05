<?php

namespace App\DataFixtures;


use App\Entity\Gear;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $gears = $manager->getRepository(Gear::class)->findAll();
        foreach($gears as $gear){
            $fix = new Item();
            $fix->addGear($gear);
            $manager->persist($fix);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            GearFixtures::class
        ];
    }
}