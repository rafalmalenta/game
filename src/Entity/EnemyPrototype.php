<?php

namespace App\Entity;

use App\Repository\EnemyPrototypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnemyPrototypeRepository::class)
 */
class EnemyPrototype
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
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $health;

    /**
     * @ORM\Column(type="integer")
     */
    private $damage;

    /**
     * @ORM\Column(type="integer")
     */
    private $accuracy;

    /**
     * @ORM\Column(type="integer")
     */
    private $defence;

    /**
     * @ORM\Column(type="integer")
     */
    private $dodge;

    /**
     * @ORM\Column(type="integer")
     */
    private $attackRange;

    /**
     * @ORM\Column(type="array")
     */
    private $coins = [];

    /**
     * @ORM\OneToMany(targetEntity=LootTable::class, mappedBy="enemy", orphanRemoval=true)
     */
    private $lootTables;

    public function __construct()
    {
        $this->lootTables = new ArrayCollection();
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }

    public function setAccuracy(int $accuracy): self
    {
        $this->accuracy = $accuracy;

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

    public function getDodge(): ?int
    {
        return $this->dodge;
    }

    public function setDodge(int $dodge): self
    {
        $this->dodge = $dodge;

        return $this;
    }

    public function getAttackRange(): ?int
    {
        return $this->attackRange;
    }

    public function setAttackRange(int $atackRange): self
    {
        $this->attackRange = $atackRange;

        return $this;
    }

    public function getCoins(): ?array
    {
        return $this->coins;
    }

    public function setCoins(array $coins): self
    {
        $this->coins = $coins;

        return $this;
    }

    /**
     * @return Collection|LootTable[]
     */
    public function getLootTables(): Collection
    {
        return $this->lootTables;
    }

    public function addLootTable(LootTable $lootTable): self
    {
        if (!$this->lootTables->contains($lootTable)) {
            $this->lootTables[] = $lootTable;
            $lootTable->setEnemy($this);
        }

        return $this;
    }

    public function removeLootTable(LootTable $lootTable): self
    {
        if ($this->lootTables->removeElement($lootTable)) {
            // set the owning side to null (unless already changed)
            if ($lootTable->getEnemy() === $this) {
                $lootTable->setEnemy(null);
            }
        }

        return $this;
    }
}
