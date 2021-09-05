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
     * @ORM\Column(type="string", length=70)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity=GearCategory::class, inversedBy="gears2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minDmg;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxdmg;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defence;

    /**
     * @ORM\ManyToOne(targetEntity=GearType::class, inversedBy="gears")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, mappedBy="gear")
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getCategory(): ?GearCategory
    {
        return $this->category;
    }

    public function setCategory(?GearCategory $category): self
    {
        $this->category = $category;

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

    public function getMaxdmg(): ?int
    {
        return $this->maxdmg;
    }

    public function setMaxdmg(int $maxdmg): self
    {
        $this->maxdmg = $maxdmg;

        return $this;
    }

    public function getDefence(): ?int
    {
        return $this->defence;
    }

    public function setDefence(?int $defence): self
    {
        $this->defence = $defence;

        return $this;
    }

    public function getType(): ?GearType
    {
        return $this->type;
    }

    public function setType(?GearType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->addGear($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            $item->removeGear($this);
        }

        return $this;
    }


}
