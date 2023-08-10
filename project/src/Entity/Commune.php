<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
#[ApiResource]
class Commune
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Fokontany::class)]
    private Collection $fokontanys;

    public function __construct()
    {
        $this->fokontanys = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Fokontany>
     */
    public function getFokontanys(): Collection
    {
        return $this->fokontanys;
    }

    public function addFokontany(Fokontany $fokontany): static
    {
        if (!$this->fokontanys->contains($fokontany)) {
            $this->fokontanys->add($fokontany);
            $fokontany->setCommune($this);
        }

        return $this;
    }

    public function removeFokontany(Fokontany $fokontany): static
    {
        if ($this->fokontanys->removeElement($fokontany)) {
            // set the owning side to null (unless already changed)
            if ($fokontany->getCommune() === $this) {
                $fokontany->setCommune(null);
            }
        }

        return $this;
    }
}
