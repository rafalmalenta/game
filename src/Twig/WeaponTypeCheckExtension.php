<?php


namespace App\Twig;

use App\Model\Weapon;
use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class WeaponTypeCheckExtension extends AbstractExtension
{

    public function getTests(): array
    {
        return [
            new TwigTest('isWeapon', [$this, 'isWeapon']),
        ];
    }

    public function isWeapon($var): bool
    {
        return $var instanceof Weapon;
    }

}