<?php

namespace App\Twig;

use App\Model\Parents\Gear;
use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class InstanceOfExtension extends AbstractExtension
{
    public function getTests(): array
    {
        return [
            new TwigTest('instanceOfGear', [$this, 'isInstanceofGear']),
        ];
    }

    public function isInstanceofGear($var): bool
    {
        return  $var instanceof Gear;
    }
}
