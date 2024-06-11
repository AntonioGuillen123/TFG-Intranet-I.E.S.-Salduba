<?php

namespace App\Entity;

use App\Repository\DisciplinePartRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisciplinePartRepository::class)]
class DisciplinePart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Crime $crime = null;

    #[ORM\ManyToOne]
    private ?CrimeMeasure $measure = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teacher $teacher = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $part_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getCrime(): ?Crime
    {
        return $this->crime;
    }

    public function setCrime(?Crime $crime): static
    {
        $this->crime = $crime;

        return $this;
    }

    public function getMeasure(): ?CrimeMeasure
    {
        return $this->measure;
    }

    public function setMeasure(?CrimeMeasure $measure): static
    {
        $this->measure = $measure;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getPartDate(): ?\DateTimeInterface
    {
        return $this->part_date;
    }

    public function setPartDate(\DateTimeInterface $part_date): static
    {
        $this->part_date = $part_date;

        return $this;
    }
}