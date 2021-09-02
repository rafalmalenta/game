<?php


namespace App\DataFixtures;

use App\Entity\Armor;
use App\Entity\Gear;
use App\Entity\Weapon;
use App\Entity\WearingPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GearFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $armors = $manager->getRepository(Armor::class)->findAll();
        $weapons = $manager->getRepository(Weapon::class)->findAll();

        foreach ($armors as $armor ) {
            $fixture = new Gear();
            $fixture->addArmor($armor);
            $manager->persist($fixture);
        }
        $manager->flush();

        foreach ($weapons as $weapon ) {
            $fixture = new Gear();
            $fixture->addWeapon($weapon);
            $manager->persist($fixture);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ArmorFixtures::class,
            WeaponFixtures::class
            ];
    }
}