<?php

namespace App\Entity;

use App\Repository\AppendixRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppendixRepository::class)
 * @ORM\Table (name="itemsTree__appendix")
 */
class Appendix
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
     * @ORM\Column(type="string", length=20)
     */
    private $boost_to;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=AppendixType::class, inversedBy="appendixes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

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

    public function getBoostTo(): ?string
    {
        return $this->boost_to;
    }

    public function setBoostTo(string $boost_to): self
    {
        $this->boost_to = $boost_to;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?AppendixType
    {
        return $this->type;
    }

    public function setType(?AppendixType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
