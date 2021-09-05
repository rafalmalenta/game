<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ORM\Table (name="itemsTree__item")
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Gear::class, inversedBy="items")
     * @JoinTable(name="itemsTree__ItemInGear")
     */
    private $gear;

    public function __construct()
    {
        $this->gear = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Gear[]
     */
    public function getGear(): Collection
    {
        return $this->gear;
    }

    public function addGear(Gear $gear): self
    {
        if (!$this->gear->contains($gear)) {
            $this->gear[] = $gear;
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        $this->gear->removeElement($gear);

        return $this;
    }
}
