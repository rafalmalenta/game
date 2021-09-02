<?php


namespace App\DataFixtures;


use App\Entity\GearCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GearCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'light armor', 'medium armor', 'heavy armor', 'sword', 'shield', 'daggers', 'hand wraps'
        ];

        foreach ($categories as $category){
            $fixture = new GearCategory();
            $fixture->setName($category);
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}