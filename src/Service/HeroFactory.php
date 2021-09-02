<?php


namespace App\Service;

use App\Entity\Armor;
use App\Entity\Weapon;
use App\Entity\WeaponBase;
use App\Model\Hero;
use App\Model\NullGear;


class HeroFactory
{

    private array $backpack;
    private array $gear;
    private array $stats;
    private array $info;
    private ?array $extraStats;
    private array $battleStats;
    /**
     * @var mixed
     */
    private $gearEntities;
    /**
     * @var mixed
     */
    private $backpackEntities;

    public function initGear()
    {
        $this->gear = [
            'mainHand'=>new NullGear(),
            'offHand'=>new NullGear(),
            'armors'=>[
                'head'=>new NullGear(),
                'chest'=>new NullGear(),
                'hands'=>new NullGear(),
                'legs' =>new NullGear(),
                'feet'=>new NullGear()
            ]
        ];
    }
    public function setHeroInitials(array $heroData): void
    {
    $this->info = $heroData['info'];
    $this->stats = $heroData['stats'];
    $this->gearEntities = $heroData['gear'];
    $this->backpackEntities = $heroData['backpack'];

    $this->initGear();
    $this->setHeroGear();
    $this->setHeroBackpack();
    }
    public function setHeroGear(): void
    {
        $gear = $this->gearEntities;
        /**
         * @var $mainHandBase WeaponBase
         */
        if ($gear['mainHand']) {
            $mainHandBase = $gear['mainHand']->getBase();
            $this->gear['mainHand'] = new \App\Model\Weapon($gear['mainHand']);
            $this->gear['mainHand']->finalizeCreation(true);
            if ($mainHandBase->getTwoHanded()) {
                $this->gear['offHand'] = new NullGear();
            }
        }
        if ($gear['offHand'] ) {
            $this->gear['offHand'] = new \App\Model\Weapon($gear['offHand']);
            $this->gear['offHand']->finalizeCreation(true);
        }
        foreach ($gear['armors'] as $armor) {
            if($armor ) {
                $this->gear['armors'][$armor->getBase()->getPlace()] = new \App\Model\Armor($armor);
                $this->gear['armors'][$armor->getBase()->getPlace()]->finalizeCreation(true);
            }
        }
    }
    public function addGearPrimaryStats()
    {
        $this->stats['displayable_damage']['min']['gear'] = $this->gear['mainHand']->stats['min'] + $this->gear['offHand']->stats['min'];
        $this->stats['displayable_damage']['max']['gear'] = $this->gear['mainHand']->stats['max'] + $this->gear['offHand']->stats['max'];
        $this->stats['displayable_battle']['defence']['gear'] = array_reduce($this->gear['armors'], function ($carry, $armor) {
            $carry += $armor->defence;
            return $carry;
        },0);
        $this->stats['displayable_battle']['defence']['gear'] += $this->gear['offHand']->stats['defence'];
    }
    public function createHero()
    {
        $this->extractStatsFromWeaponBoosts();
        $this->addMainHeroStats();
        $this->setStatsBasedOnMains();
        $this->addGearPrimaryStats();
        //$this->addStatsBasedOnMains();
        $this->addGearPrimaryStats();
        $this->sumDisplayableData();
        $backpack =$this->backpack ?? [];
        return new Hero($this->battleStats, $this->stats, $this->info,$this->gear, $backpack );
    }
    private function setStatsBasedOnMains()
    {
        $this->stats['displayable_damage']['min']['base'] = 2 * $this->getFullStatValue("strength","main");
        $this->stats['displayable_damage']['max']['base'] = 3 * $this->getFullStatValue("strength","main");
        $this->stats['displayable_battle']['health']['base'] = 15 * $this->getFullStatValue("constitution","main")
                                                            + 2 * $this->getFullStatValue("willpower","main");
        $this->stats['displayable_battle']['stamina']['base'] = 2 * $this->getFullStatValue("constitution","main")
                                                            + 10 * $this->getFullStatValue("willpower","main");
        $this->stats['displayable_battle']['defence']['base'] = 1 * $this->getFullStatValue("constitution","main");

        $this->stats['displayable_battle']['accuracy']['base'] = $this->getFullStatValue("dexterity","main");
        $this->stats['displayable_battle']['dodge']['base'] = $this->getFullStatValue("dexterity","main");

        $this->stats['displayable_extra']['critical damage']['base'] = $this->getFullStatValue("dexterity","main") + 50;
        $this->stats['displayable_extra']['block rate']['base'] = 0;

    }
    private function getFullStatValue($statName,$statGroupName): int
    {
        return array_reduce($this->stats[$statGroupName][$statName], function ($carry, $stat) {
            $carry += $stat;
            return $carry;
        },0);
    }
    private function sumDisplayableData()
    {
        $this->battleStats['damage']['min'] = $this->getFullStatValue("min","displayable_damage");
        $this->battleStats['damage']['max'] = $this->getFullStatValue("max","displayable_damage");
        foreach ($this->stats['displayable_battle'] as $name=>$displayableBattleStat)
            $this->battleStats[$name] = $this->getFullStatValue($name,"displayable_battle");

        $this->battleStats['critical damage'] = $this->getFullStatValue("critical damage","displayable_extra");
        $this->battleStats['block rate'] = $this->getFullStatValue("block rate","displayable_extra");
        $this->battleStats['attack range'] = 1;
    }

    private function extractStatsFromWeaponBoosts(): void
    {
        $extraStats = [];
        foreach ($this->gear['mainHand']->extraStats as $name=>$extraStat) {
            $extraStats[$name][] = $extraStat;
        }
        foreach ($this->gear['offHand']->extraStats as $name=>$extraStat) {
            $extraStats[$name][] = $extraStat;
        }
        foreach ($this->gear['armors'] as $place=>$armor) {
            foreach ($armor->extraStats as $name=>$extraStat){
                $extraStats[$name][] = $extraStat;
            }
        }
        $this->extraStats = $extraStats;
    }
    private function addMainHeroStats(): void
    {
        $extraStats = $this->extraStats;
        $storedStats = ['constitution', 'strength', 'wisdom','dexterity','willpower'];
        foreach ($storedStats as $statName){
            if (key_exists($statName, $extraStats )){
                $this->stats['main'][$statName]['gear'] = array_reduce($extraStats[$statName], function ($carry, $item) {
                    $carry += $item;
                    return $carry;
                },0);
            }
            else
                $this->stats['main'][$statName]['gear'] = 0;
            unset($extraStats[$statName]);
        }
        $this->extraStats = $extraStats;
    }
    private function setHeroBackpack()
    {
        $this->backpack = $this->backpackEntities;
//        foreach ($backpack as $item){
//            if ($item instanceof Weapon){
//                $backpackItem = new \App\Model\Weapon($item);
//                if($this->info['class'] === $item->getBase()->getWearableBy()->getName())
//                    $backpackItem->finalizeCreation(true);
//                $backpackItem->finalizeCreation(false);
//                $this->backpack[] = $backpackItem;
//            }
//            elseif ($item instanceof Armor){
//                $backpackItem = new \App\Model\Armor($item);
//                if(in_array($this->info['class'], $item->getBase()->getWearableBy()->getValues()))
//                    $backpackItem->finalizeCreation(true);
//                $backpackItem->finalizeCreation(false);
//                $this->backpack[] = $backpackItem;
//            }
//        }
    }
}
