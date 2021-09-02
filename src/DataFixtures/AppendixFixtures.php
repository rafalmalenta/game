<?php


namespace App\DataFixtures;


use App\Entity\Appendix;
use App\Entity\AppendixType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppendixFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $appendixes = [
            'prefix'=>[
                'great'=>[
                    'boostTo'=>'constitution',
                    'value'=> 2
                ],
                'powerful'=>[
                    'boostTo'=>'strength',
                    'value'=> 2
                ],
                'wise'=>[
                    'boostTo'=>'wisdom',
                    'value'=> 2
                ],
                'agile'=>[
                    'boostTo'=>'dexterity',
                    'value'=> 2
                ],
            ],
            'suffix'=>[
                'of tidal wave'=>[
                    'boostTo'=>'constitution',
                    'value'=> 2
                ],
                'of doom'=>[
                    'boostTo'=>'strength',
                    'value'=> 2
                ],
                'of enlightenment'=>[
                    'boostTo'=>'wisdom',
                    'value'=> 2
                ],
                'of wild cat'=>[
                    'boostTo'=>'dexterity',
                    'value'=> 2
                ],
            ]
        ];


        foreach ($appendixes as $typeName=>$typeArray ) {
            $typeEntity = $manager->getRepository(AppendixType::class)->findOneBy(['type'=>$typeName]);
            foreach ($typeArray as $appendixName => $appendixValue) {
                $fixture = new Appendix();
                $fixture->setName($appendixName)
                    ->setType($typeEntity)
                    ->setBoostTo($appendixValue['boostTo'])
                    ->setValue($appendixValue['value']);

                $manager->persist($fixture);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AppendixTypeFixtures::class];
    }
}