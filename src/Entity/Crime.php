<?php

namespace App\Entity;

use App\Repository\CrimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrimeRepository::class)]
class Crime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    private ?CrimeSeverity $severity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSeverity(): ?CrimeSeverity
    {
        return $this->severity;
    }

    public function setSeverity(?CrimeSeverity $severity): static
    {
        $this->severity = $severity;

        return $this;
    }
}
