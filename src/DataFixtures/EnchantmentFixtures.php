<?php


namespace App\DataFixtures;



use App\Entity\Enchantment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnchantmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $enchantments = [
            1, 1.5, 2, 2.5, 3,
        ];

        foreach ($enchantments as $level=>$boost ){
            $fixture = new Enchantment();
            $fixture->setLevel($level)
                ->setBoost($boost);

            $manager->persist($fixture);

        }
        $manager->flush();
    }
}