<?php


namespace App\Service\GearHandle;


use App\Entity\Hero;
use App\Entity\Weapon;
use Doctrine\ORM\EntityManagerInterface;


class WeaponHandler
{
    private Weapon $weapon;
    private Hero $hero;
    private EntityManagerInterface $em;

    public function __construct(Weapon $weapon, Hero $hero, EntityManagerInterface $em)
    {
        $this->weapon = $weapon;
        $this->hero = $hero;
        $this->em = $em;
    }
    public function wearDecide()
    {
        if ($this->weapon->getWorn() === null)
            $this->wearIt();
        else $this->takeOff();
    }
    public function wearIt(): void
    {
        $wornWeapons['mainHand'] = $this->em->getRepository(Weapon::class)->findOneBy(['owner'=>$this->hero, 'worn'=>"mainHand"]);
        $wornWeapons['offHand'] =  $this->em->getRepository(Weapon::class)->findOneBy(['owner'=>$this->hero, 'worn'=>"offHand"]);

        if($this->weapon->getBase()->getWearableBy() !== $this->hero->getClass())
            return;
        if($this->weapon->getBase()->getTwoHanded()){
            if($wornWeapons['mainHand'])
                $wornWeapons['mainHand']->setWorn(null);
            if($wornWeapons['offHand'])
                $wornWeapons['offHand']->setWorn(null);
            $this->weapon->setWorn('mainHand');
        }
        else{
            if(!$wornWeapons['mainHand'])
                $this->weapon->setWorn('mainHand');
            elseif(!$wornWeapons['offHand'])
                $this->weapon->setWorn('offHand');
            else{
                $wornWeapons['offHand']->setWorn(null);
                $this->weapon->setWorn('offHand');
            }
        }
        $this->em->flush();
    }

    public function takeOff()
    {
        $this->weapon->setWorn(null);
        $this->em->flush();
    }

}