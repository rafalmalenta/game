<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 */
class Currency
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
     * @ORM\OneToMany(targetEntity=HeroCurrency::class, mappedBy="currency", orphanRemoval=true)
     */
    private $heroCurrencies;

    public function __construct()
    {
        $this->heroCurrencies = new ArrayCollection();
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
     * @return Collection|HeroCurrency[]
     */
    public function getHeroCurrencies(): Collection
    {
        return $this->heroCurrencies;
    }

    public function addHeroCurrency(HeroCurrency $heroCurrency): self
    {
        if (!$this->heroCurrencies->contains($heroCurrency)) {
            $this->heroCurrencies[] = $heroCurrency;
            $heroCurrency->setCurrency($this);
        }

        return $this;
    }

    public function removeHeroCurrency(HeroCurrency $heroCurrency): self
    {
        if ($this->heroCurrencies->removeElement($heroCurrency)) {
            // set the owning side to null (unless already changed)
            if ($heroCurrency->getCurrency() === $this) {
                $heroCurrency->setCurrency(null);
            }
        }

        return $this;
    }
}
