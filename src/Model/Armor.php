<?php


namespace App\Model;


use App\Entity\ArmorBase;
use App\Model\Parents\Gear;

class Armor extends Gear
{
    public int $defence;

    public function __construct(?object $entity)
    {
        parent::__construct($entity);
    }
    public function finalizeCreation(bool $wearableByHero){
        $this->initialize($wearableByHero);

        $base = $this->entity->getBase();
        /**
         * @var $base ArmorBase
         */
        $this->defence = floor($base->getDefence() * pow(1.5, $this->enchantment));

    }
    public function getColor(): string
    {
        return $this->color;
    }
    public function getFullSpec()
    {
//        dump($this);
        $spec = $this->name."<hr />";
        if($this->defence)
            $spec = $spec."Defence <br />".$this->defence."<br />";
        if($this->extraStats)
            foreach ($this->extraStats as $name=>$stat){
                $spec = $spec.$name." + ".$stat."<br />";
            }
        return $spec;

    }
}