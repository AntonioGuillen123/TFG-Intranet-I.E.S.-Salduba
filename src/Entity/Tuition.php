<?php

namespace App\Entity;

use App\Repository\TuitionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TuitionRepository::class)]
class Tuition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $student = null;

    #[ORM\Column(length: 20)]
    private ?string $course = null;

    #[ORM\Column(length: 30)]
    private ?string $status_and_validity_of_tuition = null;

    #[ORM\Column(length: 20)]
    private ?string $school_expedient_number = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?string
    {
        return $this->student;
    }

    public function setStudent(string $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getStatusAndValidityOfTuition(): ?string
    {
        return $this->status_and_validity_of_tuition;
    }

    public function setStatusAndValidityOfTuition(string $status_and_validity_of_tuition): static
    {
        $this->status_and_validity_of_tuition = $status_and_validity_of_tuition;

        return $this;
    }

    public function getSchoolExpedientNumber(): ?string
    {
        return $this->school_expedient_number;
    }

    public function setSchoolExpedientNumber(string $school_expedient_number): static
    {
        $this->school_expedient_number = $school_expedient_number;

        return $this;
    }
}