<?php


namespace App\DataFixtures;


use App\Entity\AppendixType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppendixTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $appendix = ['prefix','suffix'];

        foreach ($appendix as $type ){
            $fixture = new AppendixType();
            $fixture->setType($type);

            $manager->persist($fixture);
        }
        $manager->flush();
    }
}