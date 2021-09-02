<?php


namespace App\DataFixtures;


use App\Entity\EnemyPrototype;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnemyFixturesPrototype extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $enemies = [
                [
                'name'=>'rat',
                'range'=>1,
                'coins'=>[
                    'min'=>0.01,
                    'max'=>0.05
                    ]
                ],
                [
                'name'=>'boar',
                'range'=>1,
                    'coins'=>[
                        'min'=>0.05,
                        'max'=>0.15
                    ]
                ],
                [
                'name'=>'wolf',
                'range'=>1,
                    'coins'=>[
                        'min'=>0.25,
                        'max'=>0.55
                    ]
                ]
            ];

        foreach ($enemies as $key=>$enemy){
            $number = $key + 2;
            $fix = new EnemyPrototype();
            $fix->setName($enemy['name'])
                ->setLevel($number)
                ->setAttackRange($enemy['range'])
                ->setHealth(45 * $number)
                ->setDefence(5 * $number)
                ->setDamage(10 * $number)
                ->setAccuracy(5 * $number)
                ->setDodge(5 * $number)
                ->setCoins($enemy['coins']);
            $manager->persist($fix);
        }
        $manager->flush();
    }
}
