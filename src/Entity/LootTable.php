<?php

namespace App\Entity;

use App\Repository\LootTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LootTableRepository::class)
 */
class LootTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EnemyPrototype::class, inversedBy="lootTables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enemy;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $identyfier;

    /**
     * @ORM\Column(type="array")
     */
    private $fromTables = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $probability;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnemy(): ?EnemyPrototype
    {
        return $this->enemy;
    }

    public function setEnemy(?EnemyPrototype $enemy): self
    {
        $this->enemy = $enemy;

        return $this;
    }

    public function getIdentyfier(): ?string
    {
        return $this->identyfier;
    }

    public function setIdentyfier(string $identyfier): self
    {
        $this->identyfier = $identyfier;

        return $this;
    }

    public function getFromTables(): ?array
    {
        return $this->fromTables;
    }

    public function setFromTables(array $fromTables): self
    {
        $this->fromTables = $fromTables;

        return $this;
    }

    public function getProbability(): ?int
    {
        return $this->probability;
    }

    public function setProbability(int $probability): self
    {
        $this->probability = $probability;

        return $this;
    }
}
