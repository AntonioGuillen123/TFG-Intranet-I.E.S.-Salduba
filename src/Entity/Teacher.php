<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $employe = null;

    #[ORM\Column(length: 9)]
    private ?string $dni = null;

    #[ORM\Column(length: 50)]
    private ?string $job = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_job_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_job_date = null;

    #[ORM\Column(length: 9)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $google_or_microsoft_account = null;

    #[ORM\Column]
    private ?bool $coordinator = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmploye(): ?string
    {
        return $this->employe;
    }

    public function setEmploye(string $employe): static
    {
        $this->employe = $employe;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getStartJobDate(): ?\DateTimeInterface
    {
        return $this->start_job_date;
    }

    public function setStartJobDate(\DateTimeInterface $start_job_date): static
    {
        $this->start_job_date = $start_job_date;

        return $this;
    }

    public function getEndJobDate(): ?\DateTimeInterface
    {
        return $this->end_job_date;
    }

    public function setEndJobDate(?\DateTimeInterface $end_job_date): static
    {
        $this->end_job_date = $end_job_date;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGoogleOrMicrosoftAccount(): ?string
    {
        return $this->google_or_microsoft_account;
    }

    public function setGoogleOrMicrosoftAccount(string $google_or_microsoft_account): static
    {
        $this->google_or_microsoft_account = $google_or_microsoft_account;

        return $this;
    }

    public function isCoordinator(): ?bool
    {
        return $this->coordinator;
    }

    public function setCoordinator(bool $coordinator): static
    {
        $this->coordinator = $coordinator;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}