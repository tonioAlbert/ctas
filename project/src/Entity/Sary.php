<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaryRepository::class)]
#[ApiResource]
class Sary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_size = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $table_mere = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'sary', targetEntity: Olona::class)]
    private Collection $olonas;

    public function __construct()
    {
        $this->olonas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): static
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(?string $file_path): static
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getFileSize(): ?string
    {
        return $this->file_size;
    }

    public function setFileSize(?string $file_size): static
    {
        $this->file_size = $file_size;

        return $this;
    }

    public function getTableMere(): ?string
    {
        return $this->table_mere;
    }

    public function setTableMere(?string $table_mere): static
    {
        $this->table_mere = $table_mere;

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
     * @return Collection<int, Olona>
     */
    public function getOlonas(): Collection
    {
        return $this->olonas;
    }

    public function addOlona(Olona $olona): static
    {
        if (!$this->olonas->contains($olona)) {
            $this->olonas->add($olona);
            $olona->setSary($this);
        }

        return $this;
    }

    public function removeOlona(Olona $olona): static
    {
        if ($this->olonas->removeElement($olona)) {
            // set the owning side to null (unless already changed)
            if ($olona->getSary() === $this) {
                $olona->setSary(null);
            }
        }

        return $this;
    }
}
