<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeroRepository::class)
 */
class Hero
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="hero", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $strenght;

    /**
     * @ORM\Column(type="integer")
     */
    private $dexterity;

    /**
     * @ORM\Column(type="integer")
     */
    private $wisdom;

    /**
     * @ORM\Column(type="integer")
     */
    private $willpower;

    /**
     * @ORM\Column(type="integer")
     */
    private $constitution;

    /**
     * @ORM\ManyToOne(targetEntity=HeroClass::class, inversedBy="heroes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $class;

    /**
     * @ORM\Column(type="integer")
     */
    private $stats_points;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="heroes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

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

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strenght;
    }

    public function setStrength(int $strenght): self
    {
        $this->strenght = $strenght;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getWillpower(): ?int
    {
        return $this->willpower;
    }

    public function setWillpower(int $willpower): self
    {
        $this->willpower = $willpower;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getClass(): ?HeroClass
    {
        return $this->class;
    }

    public function setClass(?HeroClass $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getStatsPoints(): ?int
    {
        return $this->stats_points;
    }

    public function setStatsPoints(int $stats_points): self
    {
        $this->stats_points = $stats_points;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }
}
