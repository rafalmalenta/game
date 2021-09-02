<?php


namespace App\DataFixtures;

use App\Entity\Armor;
use App\Entity\Weapon;
use App\Entity\WearingPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArmorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $armorWearingPlaces = ['head','chest','hands','legs','feet'];
        $armorTypes = ['light','medium','heavy'];
        $armorSets =['basic'];
        $armors = [
            'helmet'=>[
                'defence'=>1,
                'wearing'=>'head',
            ],
            'body armor'=>[
                'defence'=>1,
                'wearing'=>'chest',
            ],
            'gloves'=>[
                'defence'=>1,
                'wearing'=>'hands',
            ],
            'pants'=>[
                'defence'=>1,
                'wearing'=>'legs',
            ],
            'shoes'=>[
                'defence'=>1,
                'wearing'=>'feet',
            ],
        ];

        foreach ($armors as $armorName=>$armor ) {
            $placeEntity = $manager->getRepository(WearingPlace::class)->findOneBy(['location'=>$armor['wearing']]);
            foreach ($armorTypes as $armorType ) {
                foreach ($armorSets as $armorSet) {
                    $fixture = new Armor();
                    $fixture->setName($armorSet." ".$armorType." ".$armorName)
                        ->setWearingPlace($placeEntity)
                        ->setDefence($armor['defence'])
                        ;

                    $manager->persist($fixture);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [WearingPlaceFixtures::class];
    }
}