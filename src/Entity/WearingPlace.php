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
     * @ORM\OneToMany(targetEntity=GearType::class, mappedBy="wearingPlace", orphanRemoval=true)
     */
    private $gearTypes;

    public function __construct()
    {
        $this->gearTypes = new ArrayCollection();
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
     * @return Collection|GearType[]
     */
    public function getGearTypes(): Collection
    {
        return $this->gearTypes;
    }

    public function addGearType(GearType $gearType): self
    {
        if (!$this->gearTypes->contains($gearType)) {
            $this->gearTypes[] = $gearType;
            $gearType->setWearingPlace($this);
        }

        return $this;
    }

    public function removeGearType(GearType $gearType): self
    {
        if ($this->gearTypes->removeElement($gearType)) {
            // set the owning side to null (unless already changed)
            if ($gearType->getWearingPlace() === $this) {
                $gearType->setWearingPlace(null);
            }
        }

        return $this;
    }

}
