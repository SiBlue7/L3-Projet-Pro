<?php

namespace App\Entity;

use App\Repository\ThematiqueCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThematiqueCategoryRepository::class)
 */
class ThematiqueCategory
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Exercices::class, inversedBy="thematiqueCategories")
     */
    private $thematiqueCategories;

    public function __construct()
    {
        $this->thematiqueCategories = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ThematiqueCategory
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
    public function getThematiqueCategories(): Collection
    {
        return $this->thematiqueCategories;
    }

    public function addThematiqueCategory(Exercices $thematiqueCategory): self
    {
        if (!$this->thematiqueCategories->contains($thematiqueCategory)) {
            $this->thematiqueCategories[] = $thematiqueCategory;
        }

        return $this;
    }

    public function removeThematiqueCategory(Exercices $thematiqueCategory): self
    {
        $this->thematiqueCategories->removeElement($thematiqueCategory);

        return $this;
    }
}
