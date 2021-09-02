<?php


namespace App\Service\Battle;



use App\Entity\EnemyModifier;
use App\Entity\EnemyPrototype;
use Doctrine\ORM\EntityManagerInterface;

class EnemyChecker
{
    private EntityManagerInterface $manager;

    private array $enemyArray =[];

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function checkExistence($enemyArray) :bool
    {
        foreach ($enemyArray as $enemy){
            $enemyEntity = $this->manager->getRepository(EnemyPrototype::class)->findOneBy(["name"=>$enemy->name]);
            $modifierEntity = $this->manager->getRepository(EnemyModifier::class)->findOneBy(["name"=>$enemy->modifier]);
            if ($enemyEntity and $modifierEntity){
                if ( key_exists($enemy->name, $this->enemyArray) and
                    key_exists($enemy->modifier, $this->enemyArray[$enemy->name]))
                    $this->enemyArray[$enemy->name][$enemy->modifier]['count'] = $this->enemyArray[$enemy->name][$enemy->modifier]['count'] + $enemy->count;
                else
                    $this->enemyArray[$enemy->name][$enemy->modifier] = [
                        'enemyEntity'=>$enemyEntity,
                        'modifierEntity'=>$modifierEntity,
                        'count'=>$enemy->count];
            }
            else
                return false;
        }
        return true;
    }
    public function checkCountsInRange(array $range, array $enemyArray) :bool
    {
        foreach ($enemyArray as $enemy){
            if ($enemy->count < $range[0] OR $enemy->count > $range[1])
                return false;
        }
        return true;
    }
    public function checkAll(array $range, array $enemyArray):bool
    {
        if (!$this->checkCountsInRange($range, $enemyArray))
            return false;
        if (!$this->checkExistence($enemyArray))
            return false;
        return true;

    }
    public function returnEntities() :array
    {
        return $this->enemyArray;
    }

}