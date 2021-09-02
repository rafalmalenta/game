<?php


namespace App\Model\Parents;


use App\Model\Interfaces\FighterInterface;


abstract class Fighter implements FighterInterface
{
    use Location;
    public array $info=["name"=>""];
    public array $battleStats;
    private $focusedEnemyIndex;

    public function __construct(array $battleStats)
    {
        $this->battleStats = $battleStats;
    }
    public function doAction(array $enemies, ?array $allies) :array
    {
        if(count($enemies) <= 0)
            return [
                'who'=>$this->info['name'],
                'action'=>'cheers',
            ];
        $focusedEnemyIndex = $this->pickEnemy($enemies);

        $this->focusedEnemyIndex == $focusedEnemyIndex;
        return $this->chase($enemies[$focusedEnemyIndex], $focusedEnemyIndex);
    }
    public function chase(Fighter $enemy, int $index): array
    {
        $cords = $this->getCords();
        if ($this->getDistance($enemy) > $this->battleStats['attack range']) {
            $newCords = $this->moveTowardTarget($enemy);
            return [
                'who'=>$this->info['name'],
                'action'=>[
                    'move'=>[
                        'from'=>$cords,
                        'to'=>$newCords
                    ]]
            ];
        }
        return $this->attackEnemy($enemy, $index);
    }
    public function attackEnemy(object $enemy, int $index): array
    {
        $dmg = $this->battleStats['damage'];

        $criticalRate = floor(($this->battleStats['accuracy']/$enemy->battleStats['dodge']) * 50);
        $generatedDmg = mt_rand($dmg['min'], $dmg['max']);
        if ($criticalRate > mt_rand(0,99))
            $generatedDmg *= 1 + ($this->battleStats['critical damage']/100);

        $enemyDefence = $enemy->battleStats['defence'];
        $dmgOutput = $generatedDmg>$enemyDefence ? $generatedDmg - $enemyDefence : 1;
        $enemy->battleStats['health'] = $enemy->battleStats['health'] - $dmgOutput;
        return [
            'who'=>$this->info['name'],
            'action'=>'hit',
            'whom'=>[
                'name'=>$enemy->info['name'],
                'index'=>$index
            ],
            'for'=>$dmgOutput,
            'kills'=>$enemy->battleStats['health'] < 0
        ];
    }
    public function pickEnemy(array $enemies)
    {
        $closestDistance = 100;
        $closestIndex =" ";
        foreach ($enemies as $index=>$enemy){
            $distance = $this->getDistance($enemy);
            if($distance < $closestDistance){
                $closestDistance = $distance;
                $closestIndex = $index;
            }
        }
        return $closestIndex;
    }

}