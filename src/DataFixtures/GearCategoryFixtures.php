<?php


namespace App\DataFixtures;


use App\Entity\GearCategory;
use App\Entity\GearType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GearCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            "light armor"=>[
                "head armor","body armor","hands armor","legs armor","feet armor"
            ],
            "medium armor"=>[
                "head armor","body armor","hands armor","legs armor","feet armor"
            ],
            "heavy armor"=>[
                "head armor","body armor","hands armor","legs armor","feet armor"
            ],
            "weapon"=>[
                "dual daggers","sword","hand-to-hand","shield","alchemical pouch"
            ]
        ];

        foreach ($categories as $categoryName=>$types ) {
            $fixture = new GearCategory();
            $fixture->setName($categoryName);
            foreach ($types as $type){
                $typeEntity = $manager->getRepository(GearType::class)->findOneBy(["name"=>$type]);
                $fixture->addType($typeEntity);
                $manager->persist($fixture);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GearTypeFixtures::class
        ];
    }
}