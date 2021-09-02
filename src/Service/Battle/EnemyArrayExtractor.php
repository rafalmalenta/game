<?php


namespace App\Service\Battle;


use App\Model\Enemy;
use App\Model\Interfaces\Fighter;
use App\Service\EnemyFactory;


class EnemyArrayExtractor
{
    private array $enemies;

    public function __construct(array $enemies)
    {
        $this->enemies = $enemies;
    }
    public function extract()
    {
        $factory = new EnemyFactory();
        $oneDimensionalEnemyArray =[];
        foreach ($this->enemies as $enemyKind)
            foreach ($enemyKind as $enemyModifier)
                for($i = 1; $i <=$enemyModifier['count']; $i++){
                    $oneDimensionalEnemyArray[] = $factory->createEnemy($enemyModifier['enemyEntity'], $enemyModifier['modifierEntity']);
                }

        return $oneDimensionalEnemyArray;
    }
}