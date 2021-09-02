<?php


namespace App\Service;


use App\Entity\LootTable;
use App\Model\Enemy;
use App\Model\Hero;
use App\Service\GearHandle\GearFactory;
use Doctrine\ORM\EntityManagerInterface;

class LootGenerator
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function generate(Enemy $enemy, Hero $hero)
    {
        $items = [];
        $rateinc = $enemy->info['rewardsRank'];
        $table = $enemy->info['lootTable'];
        foreach ($table as $item){
            $random = mt_rand(1,100);
            if($item->getProbability()*$rateinc >= $random){
                $groups = $item->getFromTables();
                $randomIndex = mt_rand(0,count($groups)-1);
                $itemGroup = $groups[$randomIndex];
                $gearFactory = new GearFactory($this->manager);
                $items[] = $gearFactory->createItem($itemGroup,$item->getIdentyfier(), $rateinc, $hero);
            }
        }
        return $items;
    }
    public function extractCoinsFromEnemy(Enemy $enemy, Hero $hero)
    {

    }
}