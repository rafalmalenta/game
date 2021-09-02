<?php

namespace App\Entity;

use App\Repository\EnchantmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass=EnchantmentRepository::class)
 * @ORM\Table (name="itemsTree__enchantment")
 */
class Enchantment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="float")
     */
    private $boost;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBoost(): ?float
    {
        return $this->boost;
    }

    public function setBoost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }
}
