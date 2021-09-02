<?php


namespace App\Model\Interfaces;


interface FighterInterface
{
    public function doAction(array $enemies, ?array $allies);
}