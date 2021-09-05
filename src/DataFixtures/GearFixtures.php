<?php


namespace App\DataFixtures;


use App\Entity\Gear;
use App\Entity\GearCategory;
use App\Entity\GearType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GearFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sets = ["training"=>1,"basic"=>3];

        /**
         * @var $category GearCategory
         */
        $armors = [
            "head armor"=>"helmet",
            "body armor"=>"chest armor",
            "hands armor"=>"gloves",
            "legs armor"=>"pants",
            "feet armor"=>"boots"
        ];
        $armorsWeights = ["light","medium","heavy"];
        $weaponCategory = $manager->getRepository(GearCategory::class)->findOneBy(["name"=>"weapon"]);
        $weaponTypes = $weaponCategory->getTypes()->getValues();

        foreach ($sets as $setName=>$setValue) {
            foreach ($armors as $armorType=>$armorName) {
                foreach ($armorsWeights as $armorsWeight){
                    $fixture = new Gear();
                    $gearCategoryEntity = $manager->getRepository(GearCategory::class)->findOneBy(["name"=>$armorsWeight." armor"]);
                    $gearTypeEntity = $manager->getRepository(GearType::class)->findOneBy(["name"=>$armorType]);
                    $fixture->setCategory($gearCategoryEntity)
                        ->setType($gearTypeEntity)
                        ->setName($setName." ".$armorsWeight." ".$armorName)
                        ->setDefence($setValue);

                    $manager->persist($fixture);
                }
            }
            foreach ($weaponTypes as $type){
                $fixture = new Gear();
                $fixture->setCategory($weaponCategory)
                    ->setName($setName." ".$type->getName())
                    ->setType($type)
                    ->setMinDmg($setValue)
                    ->setMaxdmg($setValue * 2 );

                $manager->persist($fixture);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GearCategoryFixtures::class,
            GearTypeFixtures::class
        ];
    }
}