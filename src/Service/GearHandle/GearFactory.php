<?php


namespace App\Service\GearHandle;


use App\Entity\Armor;
use App\Entity\ArmorBase;
use App\Entity\Weapon;
use App\Entity\WeaponBase;
use App\Model\Hero;
use Doctrine\ORM\EntityManagerInterface;


class GearFactory
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function createItem(string $itemGroup, string $itemIdentifier, float $rateinc, Hero $hero): object
    {
        $heroEntity = $this->manager->getRepository(\App\Entity\Hero::class)->findOneBy(['name'=>$hero->info['name']]);
        if($itemGroup === "Armor"){
            $matchingBaseArray  = $this->manager->getRepository(ArmorBase::class)->findMatching($itemIdentifier);
            $isWorn = false;
            $itemEntity = new Armor();
        }
        if($itemGroup === "Weapon"){
            $matchingBaseArray = $this->manager->getRepository(WeaponBase::class)->findMatching($itemIdentifier);
            $isWorn = null;
            $itemEntity = new Weapon();
        }
        $randomItemBase = $matchingBaseArray[mt_rand(1,count($matchingBaseArray))-1];
        $itemEntity->setBase($randomItemBase)
            ->setOwner($heroEntity)
            ->setEnchantment(0)
            ->setWorn($isWorn);
            $this->manager->persist($itemEntity);
//        }
        $this->manager->flush();
        return $itemEntity;
    }
}