<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OlonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OlonaRepository::class)]
#[ApiResource]
class Olona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'olonas')]
    private ?Sary $sary = null;

    #[ORM\OneToMany(mappedBy: 'olona', targetEntity: Mipetraka::class)]
    private Collection $mipetrakas;

    public function __construct()
    {
        $this->mipetrakas = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

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

    public function getSary(): ?Sary
    {
        return $this->sary;
    }

    public function setSary(?Sary $sary): static
    {
        $this->sary = $sary;

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
            $mipetraka->setOlona($this);
        }

        return $this;
    }

    public function removeMipetraka(Mipetraka $mipetraka): static
    {
        if ($this->mipetrakas->removeElement($mipetraka)) {
            // set the owning side to null (unless already changed)
            if ($mipetraka->getOlona() === $this) {
                $mipetraka->setOlona(null);
            }
        }

        return $this;
    }
}
