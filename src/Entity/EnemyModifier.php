<?php

namespace App\Entity;

use App\Repository\EnemyModifierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnemyModifierRepository::class)
 */
class EnemyModifier
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
     * @ORM\Column(type="array")
     */
    private $boost_to = [];

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



    public function getBoostTo(): ?array
    {
        return $this->boost_to;
    }

    public function setBoostTo(array $boost_to): self
    {
        $this->boost_to = $boost_to;

        return $this;
    }
}
