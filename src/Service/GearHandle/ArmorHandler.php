<?php


namespace App\Service\GearHandle;


use App\Entity\Armor;
use App\Entity\Hero;
use Doctrine\ORM\EntityManagerInterface;

class ArmorHandler
{
    private Armor $armor;
    private Hero $hero;
    private EntityManagerInterface $em;

    public function __construct(Armor $armor, Hero $hero, EntityManagerInterface $em)
    {

        $this->armor = $armor;
        $this->hero = $hero;
        $this->em = $em;
    }
    public function wearDecide()
    {
        if ($this->armor->getWorn() === false)
            $this->wearIt();
        else $this->takeOff();
    }
    public function takeOff()
    {
        $this->armor->setWorn(false);
        $this->em->flush();
    }
    public function wearIt()
    {
        $wornArmors = $this->em->getRepository(Armor::class)->findBy(['owner'=>$this->hero, 'is_worn'=>true]);
        if(in_array($this->hero->getClass(), $this->armor->getBase()->getWearableBy()->getValues())){
            foreach ($wornArmors as $armor){
                if($armor->getBase()->getPlace() === $this->armor->getBase()->getPlace())
                    $armor->setWorn(false);
            }
            $this->armor->setWorn(true);
            $this->em->flush();
        }
    }
}