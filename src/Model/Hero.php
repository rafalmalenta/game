<?php


namespace App\Model;


use App\Model\Parents\Fighter;

class Hero extends Fighter
{
    public array $stats;
    public array $info;
    public array $gear;
    public array $backpack;

    public function __construct(array $battleStats, array $displayableStats, array $info, array $gear, array $backpack)
    {
        parent::__construct($battleStats);
        $this->stats = $displayableStats;
        $this->info = $info;
        $this->gear = $gear;
        $this->backpack = $backpack;
        $this->info['backpackSize'] = count($this->backpack);
    }
    public function getFullStatValue($statName,$statGroupName): int
    {
        return array_reduce($this->stats[$statGroupName][$statName], function ($carry, $stat) {
            $carry += $stat;
            return $carry;
        },0);
    }
}