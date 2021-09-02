<?php


namespace App\Service;


use App\Entity\EnemyModifier;
use App\Entity\EnemyPrototype;
use App\Model\Enemy;

class EnemyFactory
{

    public function __construct()
    {
    }

    public function createEnemy(EnemyPrototype $proto, EnemyModifier $modifierEntity)
    {
        $info['coinsArray'] = $proto->getCoins();
        $info['name'] = $modifierEntity->getName()." ".$proto->getName();
        $info['level'] = $proto->getLevel();
        $info['lootTable'] = $proto->getLootTables();
        $battleStats['damage']['min'] = $proto->getDamage();
        $battleStats['damage']['max'] = $proto->getDamage();
        $battleStats['health'] = $proto->getHealth();
        $battleStats['accuracy'] = $proto->getAccuracy();
        $battleStats['defence'] = $proto->getDefence();
        $battleStats['dodge'] = $proto->getDodge();
        $battleStats['attackRange'] = $proto->getAttackRange();
        $battleStats['block rate'] = 0;
        $battleStats['critical damage'] = 50;
        $battleStats['attack range'] = 1;
        $modifiers = $modifierEntity->getBoostTo();
        $rewardsRank = 1;
        foreach ($modifiers as $modifier) {
            $rewardsRank *= $modifier['value'];
            if($modifier['name']='damage'){
                $battleStats['damage']['min'] = floor($battleStats['damage']['min'] * $modifier['value']);
                $battleStats['damage']['max'] = floor($battleStats['damage']['max'] * $modifier['value']);
            }
            else
                $battleStats[$modifier['name']] = (float)$battleStats[$modifier['name']] * (float)$modifier['value'];
        }
        $info['rewardsRank'] = floor(pow($rewardsRank, 0.25) * 100)/100;

        return new Enemy($info,$battleStats);
    }
}