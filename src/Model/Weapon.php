<?php


namespace App\Model;


use App\Entity\WeaponBase;
use App\Model\Parents\Gear;

class Weapon extends Gear
{

    public array $stats;

    public function __construct(?object $entity)
    {
        parent::__construct($entity);
    }

    public function finalizeCreation(bool $wearableByHero){
        $this->initialize($wearableByHero);

        $base = $this->entity->getBase();
        /**
         * @var $base WeaponBase
         */
        $this->stats['min'] = floor($base->getMinDmg() * pow(1.5, $this->enchantment));
        $this->stats['max'] = floor($base->getMaxDmg() * pow(1.5, $this->enchantment));
        $this->stats['defence'] = floor($base->getDefence() * pow(1.5, $this->enchantment));
    }
    public function getFullSpec()
    {
        $spec = $this->name."<hr />";
        if($this->stats['min'])
            $spec = $spec."Damage <br />".$this->stats['min']." - ".$this->stats['max']."<br />";
        if($this->stats['defence'])
            $spec = $spec."Defence <br />".$this->stats['defence']."<br />";
        if($this->extraStats)
            foreach ($this->extraStats as $name=>$stat){
                $spec = $spec.$name." + ".$stat."<br />";
            }
        return $spec;

    }
}