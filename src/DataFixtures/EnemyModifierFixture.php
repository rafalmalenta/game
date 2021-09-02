<?php


namespace App\DataFixtures;


use App\Entity\EnemyModifier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class EnemyModifierFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $modifiers= [
            'sick'=>[
                'health'=>0.5,
            ],
            'weakened'=>[
                'damage'=> 0.75
            ],
            'frenzied'=>[
                'damage'=> 1.2
            ],
            'elite'=>[
                'health'=> 1.5,
                'damage'=> 1.5,
            ],
            'heroic'=>[
                'health'=> 1.75,
                'damage'=> 1.75,
                'defence'=> 1.75,
            ],
        ];
        foreach ($modifiers as $name=>$modifier){
            $fixture = new EnemyModifier();
            $boostArray = [];
            $fixture->setName($name);
            foreach ($modifier as $modifies=>$value)
                $boostArray[] = ['name'=>$modifies,'value'=>$value];
            $fixture->setBoostTo($boostArray);
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}