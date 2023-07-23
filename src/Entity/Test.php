<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $inputs = [];

    /**
     * @ORM\Column(type="json")
     */
    private $outputs = [];

    /**
     * @ORM\ManyToMany(targetEntity=Exercices::class, inversedBy="tests")
     */
    private $exercices;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getInputs(): ?array
    {
        return $this->inputs;
    }

    public function setInputs(array $inputs): self
    {
        $this->inputs = $inputs;

        return $this;
    }

    public function getOutputs(): ?array
    {
        return $this->outputs;
    }

    public function setOutputs(array $outputs): self
    {
        $this->outputs = $outputs;

        return $this;
    }

    /**
     * @return Collection<int, Exercices>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercices $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices[] = $exercice;
        }

        return $this;
    }

    public function removeExercice(Exercices $exercice): self
    {
        $this->exercices->removeElement($exercice);

        return $this;
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
}
