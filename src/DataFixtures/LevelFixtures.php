<?php


namespace App\DataFixtures;


use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LevelFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<50; $i++){
            $fix = new Level();
            $fix->setLevel($i)
                ->setXPtoNext($i*($i+1)*20);
            $manager->persist($fix);
        }
        $manager->flush();
    }
}