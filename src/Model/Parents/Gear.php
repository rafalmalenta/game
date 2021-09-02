<?php


namespace App\Model\Parents;


class Gear extends Item
{
    public int $enchantment;

    public string $color;

    public array $extraStats;

    public bool $wearableByHero;

    public int $id;

    public function __construct(?object $entity)
    {
        parent::__construct($entity);
    }
    public function initialize(bool $wearableByHero): void
    {
        $this->setName();
        $entity = $this->entity;
        $this->id =$entity->getId();
        $prefix = $entity->getPrefix();
        $suffix = $entity->getSuffix();
        $prefixName = "";
        $suffixName = "";
        $this->extraStats = [];
        $extraStats = [];
        if ($prefix) {
            $extraStats[$prefix->getBoostTo()][] = $prefix->getValue();
            $prefixName = $prefix->getName()." ";
        }
        if ($suffix){
            $extraStats[$suffix->getBoostTo()][] = $suffix->getValue();
            $suffixName = " ".$suffix->getName();
        }
        foreach ($extraStats as $name=>$extraStatArray){
            $this->extraStats[$name] = array_reduce($extraStatArray, function ($carry, $item){
                $carry += $item;
                return $carry;
            });
        }

        $this->wearableByHero = $wearableByHero;

        $this->color = "#".($prefix?"00":"FF")."FF".($suffix?"00":"FF");

        $this->enchantment = $entity->getEnchantment();

        $this->name = $prefixName.$this->name.$suffixName;
        if($this->enchantment>0)
            $this->name = $this->name." + ".$this->enchantment;
    }

}