<?php

namespace App\Entity;

use App\Repository\ExercicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExercicesRepository::class)
 */
class Exercices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $Enonce;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resultat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=LanguageCategory::class, mappedBy="Exercice")
     */
    private $languageCategories;

    /**
     * @ORM\ManyToMany(targetEntity=ThematiqueCategory::class, mappedBy="thematiqueCategories")
     */
    private $thematiqueCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Test::class, mappedBy="exercices")
     */
    private $tests;

    public function __construct()
    {
        $this->languageCategories = new ArrayCollection();
        $this->thematiqueCategories = new ArrayCollection();
        $this->tests = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getEnonce(): ?string
    {
        return $this->Enonce;
    }

    public function setEnonce(string $Enonce): self
    {
        $this->Enonce = $Enonce;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, LanguageCategory>
     */
    public function getLanguageCategories(): Collection
    {
        return $this->languageCategories;
    }

    public function addLanguageCategory(LanguageCategory $languageCategory): self
    {
        if (!$this->languageCategories->contains($languageCategory)) {
            $this->languageCategories[] = $languageCategory;
            $languageCategory->addExercice($this);
        }

        return $this;
    }

    public function removeLanguageCategory(LanguageCategory $languageCategory): self
    {
        if ($this->languageCategories->removeElement($languageCategory)) {
            $languageCategory->removeExercice($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ThematiqueCategory>
     */
    public function getThematiqueCategories(): Collection
    {
        return $this->thematiqueCategories;
    }

    public function addThematiqueCategory(ThematiqueCategory $thematiqueCategory): self
    {
        if (!$this->thematiqueCategories->contains($thematiqueCategory)) {
            $this->thematiqueCategories[] = $thematiqueCategory;
            $thematiqueCategory->addThematiqueCategory($this);
        }

        return $this;
    }

    public function removeThematiqueCategory(ThematiqueCategory $thematiqueCategory): self
    {
        if ($this->thematiqueCategories->removeElement($thematiqueCategory)) {
            $thematiqueCategory->removeThematiqueCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->addExercice($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            $test->removeExercice($this);
        }

        return $this;
    }
}
