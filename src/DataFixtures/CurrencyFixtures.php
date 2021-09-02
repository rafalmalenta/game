<?php

namespace App\DataFixtures;


use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $currency = new Currency();
        $currency->setName("Gold Coins");
        $manager->persist($currency);
        $manager->flush();
    }
}