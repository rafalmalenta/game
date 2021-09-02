<?php


namespace App\DataFixtures;


use App\Entity\HeroClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $knight = new HeroClass();
    $knight->setName("Knight")
        ->setDescription("Knights are well trained in using two-handed weapons or weapon and shields, 
        they value strength and constitution like no other, thanks to this only they can wear heavy steal armors");
    $manager->persist($knight);

    $rogue = new HeroClass();
    $rogue->setName("Rogue")
        ->setDescription("Rogues are agile dirty fighters, in combat they use dual daggers or bows and medium armors");
    $manager->persist($rogue);

    $alchemist = new HeroClass();
    $alchemist->setName("Alchemist")
        ->setDescription("Alchemist is a person dedicated to wisdom, they fight bear handed but use deadly poisons and life saving drugs");
    $manager->persist($alchemist);

    $manager->flush();
    }
}