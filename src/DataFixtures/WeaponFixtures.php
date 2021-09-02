<?php


namespace App\DataFixtures;

use App\Entity\Weapon;
use App\Entity\WearingPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WeaponFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $weapons = [
            'training sword'=>[
                'minDmg'=>1,
                'maxDmg'=>2,
                'wearing'=>'main hand'
            ],
            'training daggers'=>[
                'minDmg'=>2,
                'maxDmg'=>3,
                'wearing'=>'both hands'
            ],
            'training shield'=>[
                'minDmg'=>1,
                'maxDmg'=>1,
                'wearing'=>'off hand'
            ],
        ];

        foreach ($weapons as $weaponName=>$weapon ) {
            $placeEntity = $manager->getRepository(WearingPlace::class)->findOneBy(['location'=>$weapon['wearing']]);
                $fixture = new Weapon();
                $fixture->setName($weaponName)
                    ->setWearingPlace($placeEntity)
                    ->setMinDmg($weapon['minDmg'])
                    ->setMaxDmg($weapon['maxDmg']);

                $manager->persist($fixture);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [WearingPlaceFixtures::class];
    }
}