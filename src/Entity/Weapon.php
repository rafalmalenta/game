<?php

namespace App\Entity;

use App\Repository\WeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeaponRepository::class)
 * @ORM\Table (name="itemsTree__weapon")
 */
class Weapon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $minDmg;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxDmg;

    /**
     * @ORM\ManyToOne(targetEntity=WearingPlace::class, inversedBy="weapons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wearingPlace;

    /**
     * @ORM\ManyToMany(targetEntity=Gear::class, mappedBy="isWeapon")
     */
    private $gears;

    public function __construct()
    {
        $this->gears = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMinDmg(): ?int
    {
        return $this->minDmg;
    }

    public function setMinDmg(int $minDmg): self
    {
        $this->minDmg = $minDmg;

        return $this;
    }

    public function getMaxDmg(): ?int
    {
        return $this->maxDmg;
    }

    public function setMaxDmg(int $maxDmg): self
    {
        $this->maxDmg = $maxDmg;

        return $this;
    }

    public function getWearingPlace(): ?WearingPlace
    {
        return $this->wearingPlace;
    }

    public function setWearingPlace(?WearingPlace $wearingPlace): self
    {
        $this->wearingPlace = $wearingPlace;

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
            $gear->addIsWeapon($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            $gear->removeIsWeapon($this);
        }

        return $this;
    }
}
