<?php

namespace App\Entity;

use App\Repository\GearCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GearCategoryRepository::class)
 * @ORM\Table (name="itemsTree__gearCategory")
 */
class GearCategory
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Gear::class, mappedBy="category", orphanRemoval=true)
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
            $gear->setCategory($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            // set the owning side to null (unless already changed)
            if ($gear->getCategory() === $this) {
                $gear->setCategory(null);
            }
        }

        return $this;
    }
}
