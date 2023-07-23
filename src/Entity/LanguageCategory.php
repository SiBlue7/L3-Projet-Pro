<?php

namespace App\Entity;

use App\Repository\LanguageCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageCategoryRepository::class)
 */
class LanguageCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Exercices::class, inversedBy="languageCategories")
     */
    private $Exercice;

    public function __construct()
    {
        $this->Exercice = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): LanguageCategory
    {
        $this->id = $id;

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

    /**
     * @return Collection<int, Exercices>
     */
    public function getExercice(): Collection
    {
        return $this->Exercice;
    }

    public function addExercice(Exercices $exercice): self
    {
        if (!$this->Exercice->contains($exercice)) {
            $this->Exercice[] = $exercice;
        }

        return $this;
    }

    public function removeExercice(Exercices $exercice): self
    {
        $this->Exercice->removeElement($exercice);

        return $this;
    }
}
