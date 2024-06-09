<?php

namespace App\Entity;

use App\Repository\AbsenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbsenceRepository::class)]
class Absence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $absence_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $task = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Schedule $hour = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teacher $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbsenceDate(): ?\DateTimeInterface
    {
        return $this->absence_date;
    }

    public function setAbsenceDate(\DateTimeInterface $absence_date): static
    {
        $this->absence_date = $absence_date;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): static
    {
        $this->task = $task;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getHour(): ?Schedule
    {
        return $this->hour;
    }

    public function setHour(?Schedule $hour): static
    {
        $this->hour = $hour;

        return $this;
    }

    public function getAuthor(): ?Teacher
    {
        return $this->author;
    }

    public function setAuthor(?Teacher $author): static
    {
        $this->author = $author;

        return $this;
    }
}
