<?php


namespace App\Model;


use App\Model\Parents\Gear;

class NullGear extends Gear
{
    public int $defence;
    /**
     * @var int[]
     */
    public array $stats;
    public array $extraStats = [];

    public function __construct()
    {
        parent::__construct(null);
        $this->extraStats = [];
        $this->stats = [
            'min'=>0,
            'max'=>0,
            'defence'=>0
        ];
        $this->defence = 0;
    }
    public function id()
    {
    return false;
    }

    public function getName(): string
    {
        return "Empty slot";
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return "#FFFFFF";
    }
    public function getFullSpec()
    {
        return "";
    }




}