<?php

namespace App\Entity;

use App\Repository\WearingPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WearingPlaceRepository::class)
 * @ORM\Table (name="itemsTree__wearingPlace")
 */
class WearingPlace
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity=Gear::class, mappedBy="wearingPlace", orphanRemoval=true)
     */
    private $gears;

    /**
     * @ORM\OneToMany(targetEntity=Weapon::class, mappedBy="wearingPlace", orphanRemoval=true)
     */
    private $weapons;

    /**
     * @ORM\OneToMany(targetEntity=Armor::class, mappedBy="wearingPlace", orphanRemoval=true)
     */
    private $armors;

    public function __construct()
    {
        $this->gears = new ArrayCollection();
        $this->weapons = new ArrayCollection();
        $this->armors = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|Gear[]
     */
    public function getGears(): Collection
    {
        return $this->gears;
    }

    public function addGear(Gear $gear): self
    {
        if (!$this->gears->contains($gear)) {
            $this->gears[] = $gear;
            $gear->setWearingPlace($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            // set the owning side to null (unless already changed)
            if ($gear->getWearingPlace() === $this) {
                $gear->setWearingPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Weapon[]
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapon $weapon): self
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons[] = $weapon;
            $weapon->setWearingPlace($this);
        }

        return $this;
    }

    public function removeWeapon(Weapon $weapon): self
    {
        if ($this->weapons->removeElement($weapon)) {
            // set the owning side to null (unless already changed)
            if ($weapon->getWearingPlace() === $this) {
                $weapon->setWearingPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Armor[]
     */
    public function getArmors(): Collection
    {
        return $this->armors;
    }

    public function addArmor(Armor $armor): self
    {
        if (!$this->armors->contains($armor)) {
            $this->armors[] = $armor;
            $armor->setWearingPlace($this);
        }

        return $this;
    }

    public function removeArmor(Armor $armor): self
    {
        if ($this->armors->removeElement($armor)) {
            // set the owning side to null (unless already changed)
            if ($armor->getWearingPlace() === $this) {
                $armor->setWearingPlace(null);
            }
        }

        return $this;
    }
}
