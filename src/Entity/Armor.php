<?php

namespace App\Entity;

use App\Repository\ArmorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmorRepository::class)
 * @ORM\Table (name="itemsTree__armor")
 */
class Armor
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
    private $defence;

    /**
     * @ORM\ManyToOne(targetEntity=WearingPlace::class, inversedBy="armors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wearingPlace;

    /**
     * @ORM\ManyToMany(targetEntity=Gear::class, mappedBy="isArmor")
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

    public function getDefence(): ?int
    {
        return $this->defence;
    }

    public function setDefence(int $defence): self
    {
        $this->defence = $defence;

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
            $gear->addArmor($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            $gear->removeArmor($this);
        }

        return $this;
    }
}
