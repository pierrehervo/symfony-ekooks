<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantité;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=recettes::class, inversedBy="id_ingredient")
     */
    private $id_recette;

    public function __construct()
    {
        $this->id_recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(?int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|recettes[]
     */
    public function getIdRecette(): Collection
    {
        return $this->id_recette;
    }

    public function addIdRecette(recettes $idRecette): self
    {
        if (!$this->id_recette->contains($idRecette)) {
            $this->id_recette[] = $idRecette;
        }

        return $this;
    }

    public function removeIdRecette(recettes $idRecette): self
    {
        $this->id_recette->removeElement($idRecette);

        return $this;
    }
}
