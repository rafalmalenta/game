<?php

namespace App\Entity;

use App\Repository\AppendixTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppendixTypeRepository::class)
 * @ORM\Table (name="itemsTree__appendixType")
 */
class AppendixType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Appendix::class, mappedBy="type", orphanRemoval=true)
     */
    private $appendixes;

    public function __construct()
    {
        $this->appendixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Appendix[]
     */
    public function getAppendixes(): Collection
    {
        return $this->appendixes;
    }

    public function addAppendix(Appendix $appendix): self
    {
        if (!$this->appendixes->contains($appendix)) {
            $this->appendixes[] = $appendix;
            $appendix->setType($this);
        }

        return $this;
    }

    public function removeAppendix(Appendix $appendix): self
    {
        if ($this->appendixes->removeElement($appendix)) {
            // set the owning side to null (unless already changed)
            if ($appendix->getType() === $this) {
                $appendix->setType(null);
            }
        }

        return $this;
    }
}
