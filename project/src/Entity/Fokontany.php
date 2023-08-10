<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FokontanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FokontanyRepository::class)]
#[ApiResource]
class Fokontany
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

    #[ORM\ManyToOne(inversedBy: 'fokontanys')]
    private ?Commune $commune = null;

    #[ORM\OneToMany(mappedBy: 'fokontany', targetEntity: Mipetraka::class)]
    private Collection $mipetrakas;

    public function __construct()
    {
        $this->mipetrakas = new ArrayCollection();
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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection<int, Mipetraka>
     */
    public function getMipetrakas(): Collection
    {
        return $this->mipetrakas;
    }

    public function addMipetraka(Mipetraka $mipetraka): static
    {
        if (!$this->mipetrakas->contains($mipetraka)) {
            $this->mipetrakas->add($mipetraka);
            $mipetraka->setFokontany($this);
        }

        return $this;
    }

    public function removeMipetraka(Mipetraka $mipetraka): static
    {
        if ($this->mipetrakas->removeElement($mipetraka)) {
            // set the owning side to null (unless already changed)
            if ($mipetraka->getFokontany() === $this) {
                $mipetraka->setFokontany(null);
            }
        }

        return $this;
    }
}
