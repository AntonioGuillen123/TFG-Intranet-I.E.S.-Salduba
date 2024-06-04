<?php

namespace App\Entity;

use App\Repository\TeacherScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherScheduleRepository::class)]
class TeacherSchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $day_number = null;

    #[ORM\Column]
    private ?int $hour_number = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $subject_abbreviation = null;

    #[ORM\Column(length: 30)]
    private ?string $subject = null;

    #[ORM\Column(length: 50)]
    private ?string $teacher_name = null;

    #[ORM\Column(length: 50)]
    private ?string $classroom_name = null;

    #[ORM\Column(length: 50)]
    private ?string $group_name = null;

    #[ORM\Column(length: 5)]
    private ?string $start_hour = null;

    #[ORM\Column(length: 5)]
    private ?string $end_hour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayNumber(): ?int
    {
        return $this->day_number;
    }

    public function setDayNumber(int $day_number): static
    {
        $this->day_number = $day_number;

        return $this;
    }

    public function getHourNumber(): ?int
    {
        return $this->hour_number;
    }

    public function setHourNumber(int $hour_number): static
    {
        $this->hour_number = $hour_number;

        return $this;
    }

    public function getSubjectAbbreviation(): ?string
    {
        return $this->subject_abbreviation;
    }

    public function setSubjectAbbreviation(?string $subject_abbreviation): static
    {
        $this->subject_abbreviation = $subject_abbreviation;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTeacherName(): ?string
    {
        return $this->teacher_name;
    }

    public function setTeacherName(string $teacher_name): static
    {
        $this->teacher_name = $teacher_name;

        return $this;
    }

    public function getClassroomName(): ?string
    {
        return $this->classroom_name;
    }

    public function setClassroomName(string $classroom_name): static
    {
        $this->classroom_name = $classroom_name;

        return $this;
    }

    public function getGroupName(): ?string
    {
        return $this->group_name;
    }

    public function setGroupName(string $group_name): static
    {
        $this->group_name = $group_name;

        return $this;
    }

    public function getStartHour(): ?string
    {
        return $this->start_hour;
    }

    public function setStartHour(string $start_hour): static
    {
        $this->start_hour = $start_hour;

        return $this;
    }

    public function getEndHour(): ?string
    {
        return $this->end_hour;
    }

    public function setEndHour(string $end_hour): static
    {
        $this->end_hour = $end_hour;

        return $this;
    }
}
