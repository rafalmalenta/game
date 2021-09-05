<?php

namespace App\Entity;

use App\Repository\GearCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

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

    /**
     * @ORM\ManyToMany(targetEntity=GearType::class, inversedBy="gearCategories")
     * @JoinTable(name="itemsTree__TypeInCategory")
     */
    private $types;

    public function __construct()
    {
        $this->gears = new ArrayCollection();
        $this->gears = new ArrayCollection();
        $this->types = new ArrayCollection();
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

    public function addGears(Gear $gears): self
    {
        if (!$this->gears->contains($gears)) {
            $this->gears[] = $gears;
            $gears->setCategory($this);
        }

        return $this;
    }

    public function removeGears(Gear $gears): self
    {
        if ($this->gears->removeElement($gears)) {
            // set the owning side to null (unless already changed)
            if ($gears->getCategory() === $this) {
                $gears->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GearType[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(GearType $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(GearType $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }
}
