<?php

namespace App\DataFixtures;


use App\Entity\GearType;
use App\Entity\WearingPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GearTypeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $gearTypes = [
            "head armor"=>"head",
            "body armor"=>"chest",
            "hands armor"=>"hands",
            "legs armor"=>"legs",
            "feet armor"=>"feet",
            "dual daggers"=>"both hands",
            "sword"=>"main hand",
            "hand-to-hand"=>"main hand",
            "shield"=>"off hand",
            "alchemical pouch"=>"off hand"
        ];

        foreach($gearTypes as $gearType=>$wearingPlace){
            $fix = new GearType();
            $placeEntity = $manager->getRepository(WearingPlace::class)->findOneBy(["location"=>$wearingPlace]);
            $fix->setName($gearType)
                ->setWearingPlace($placeEntity);
            $manager->persist($fix);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            WearingPlaceFixtures::class
        ];
        // TODO: Implement getDependencies() method.
    }
}