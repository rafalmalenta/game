<?php

namespace App\Entity;

use App\Repository\GearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass=GearRepository::class)
 * @ORM\Table (name="itemsTree__gear")
 */
class Gear
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Armor::class, inversedBy="gears")
     * @JoinTable (name="itemsTree__gearIsArmor")
     */
    private $armor;

    /**
     * @ORM\ManyToMany(targetEntity=Weapon::class, inversedBy="gears")
     * @JoinTable (name="itemsTree__gearIsWeapon")
     */
    private $weapon;

    public function __construct()
    {
        $this->armor = new ArrayCollection();
        $this->weapon = new ArrayCollection();
    }

    /**
     * @return Collection|Armor[]
     */
    public function getArmor(): Collection
    {
        return $this->armor;
    }

    public function addArmor(Armor $isArmor): self
    {
        if (!$this->armor->contains($isArmor)) {
            $this->armor[] = $isArmor;
        }

        return $this;
    }

    public function removeArmor(Armor $isArmor): self
    {
        $this->armor->removeElement($isArmor);

        return $this;
    }

    /**
     * @return Collection|Weapon[]
     */
    public function getWeapon(): Collection
    {
        return $this->weapon;
    }

    public function addWeapon(Weapon $isWeapon): self
    {
        if (!$this->weapon->contains($isWeapon)) {
            $this->weapon[] = $isWeapon;
        }

        return $this;
    }

    public function removeIsWeapon(Weapon $weapon): self
    {
        $this->weapon->removeElement($weapon);

        return $this;
    }


}
