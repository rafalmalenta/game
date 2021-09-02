<?php


namespace App\Model;


use App\Model\Parents\Fighter;
use App\Model\Parents\Location;

class Enemy extends Fighter
{
    use Location;

    public function __construct(array $info, array $battleStats)
    {
        $this->info = $info;
        parent::__construct($battleStats);
    }

}
