<?php

namespace App\Entity;

use App\Repository\GearTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GearTypeRepository::class)
 * @ORM\Table (name="itemsTree__gearType")
 */
class GearType
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
     * @ORM\OneToMany(targetEntity=Gear::class, mappedBy="type", orphanRemoval=true)
     */
    private $gears;

    /**
     * @ORM\ManyToMany(targetEntity=GearCategory::class, mappedBy="hasTypes")
     */
    private $gearCategories;

    /**
     * @ORM\ManyToOne(targetEntity=WearingPlace::class, inversedBy="gearTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wearingPlace;

    public function __construct()
    {
        $this->gears = new ArrayCollection();
        $this->gearCategories = new ArrayCollection();
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
            $gear->setType($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            // set the owning side to null (unless already changed)
            if ($gear->getType() === $this) {
                $gear->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GearCategory[]
     */
    public function getGearCategories(): Collection
    {
        return $this->gearCategories;
    }

    public function addGearCategory(GearCategory $gearCategory): self
    {
        if (!$this->gearCategories->contains($gearCategory)) {
            $this->gearCategories[] = $gearCategory;
            $gearCategory->addType($this);
        }

        return $this;
    }

    public function removeGearCategory(GearCategory $gearCategory): self
    {
        if ($this->gearCategories->removeElement($gearCategory)) {
            $gearCategory->removeType($this);
        }

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
}
