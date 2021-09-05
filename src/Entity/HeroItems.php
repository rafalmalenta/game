<?php

namespace App\Entity;

use App\Repository\HeroItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeroItemsRepository::class)
 */
class HeroItems
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint", options={"unsigned"=true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Hero::class, inversedBy="heroItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hero;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\ManyToMany(targetEntity=Enchantment::class)
     */
    private $enchantment;

    /**
     * @ORM\ManyToOne(targetEntity=WearingPlace::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    public function __construct()
    {
        $this->enchantment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): self
    {
        $this->hero = $hero;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Collection|Enchantment[]
     */
    public function getEnchantment(): Collection
    {
        return $this->enchantment;
    }

    public function addEnchantment(Enchantment $enchantment): self
    {
        if (!$this->enchantment->contains($enchantment)) {
            $this->enchantment[] = $enchantment;
        }

        return $this;
    }

    public function removeEnchantment(Enchantment $enchantment): self
    {
        $this->enchantment->removeElement($enchantment);

        return $this;
    }

    public function getLocation(): ?WearingPlace
    {
        return $this->location;
    }

    public function setLocation(?WearingPlace $location): self
    {
        $this->location = $location;

        return $this;
    }
}
