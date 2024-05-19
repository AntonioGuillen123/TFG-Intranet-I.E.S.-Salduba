<?php

namespace App\Entity;

use App\Repository\CTeachersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CTeachersRepository::class)]
class CTeachers
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id_teacher = null;

    #[ORM\Column(length: 48, nullable: true)]
    private ?string $pass = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $name_teacher = null;

    #[ORM\Column(length: 10)]
    private ?string $dni = null;

    #[ORM\Column(length: 12)]
    private ?string $idea = null;

    #[ORM\Column]
    private ?int $id_department = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $state = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $alias_teacher = null;

    #[ORM\Column]
    private ?bool $id_language = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $top_secret = null;

    #[ORM\Column]
    private ?bool $consent = null;

    #[ORM\Column(nullable: true)]
    private ?bool $email_warning = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tmp = null;

    #[ORM\Column(nullable: true)]
    private ?bool $personal_warning = null;

    #[ORM\Column]
    private ?bool $shortcut_menu = null;

    #[ORM\Column]
    private ?bool $side_shortcut_menu = null;

    #[ORM\Column(nullable: true)]
    private ?int $asistence_number = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $highschool_email = null;

    #[ORM\Column]
    private ?int $caped = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTeacher(): ?int
    {
        return $this->id_teacher;
    }

    public function setIdTeacher(int $id_teacher): static
    {
        $this->id_teacher = $id_teacher;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(?string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function getNameTeacher(): ?string
    {
        return $this->name_teacher;
    }

    public function setNameTeacher(?string $name_teacher): static
    {
        $this->name_teacher = $name_teacher;

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

    public function getIdea(): ?string
    {
        return $this->idea;
    }

    public function setIdea(string $idea): static
    {
        $this->idea = $idea;

        return $this;
    }

    public function getIdDepartment(): ?int
    {
        return $this->id_department;
    }

    public function setIdDepartment(int $id_department): static
    {
        $this->id_department = $id_department;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAliasTeacher(): ?string
    {
        return $this->alias_teacher;
    }

    public function setAliasTeacher(?string $alias_teacher): static
    {
        $this->alias_teacher = $alias_teacher;

        return $this;
    }

    public function isIdLanguage(): ?bool
    {
        return $this->id_language;
    }

    public function setIdLanguage(bool $id_language): static
    {
        $this->id_language = $id_language;

        return $this;
    }

    public function getTopSecret(): ?string
    {
        return $this->top_secret;
    }

    public function setTopSecret(?string $top_secret): static
    {
        $this->top_secret = $top_secret;

        return $this;
    }

    public function isConsent(): ?bool
    {
        return $this->consent;
    }

    public function setConsent(bool $consent): static
    {
        $this->consent = $consent;

        return $this;
    }

    public function isEmailWarning(): ?bool
    {
        return $this->email_warning;
    }

    public function setEmailWarning(?bool $email_warning): static
    {
        $this->email_warning = $email_warning;

        return $this;
    }

    public function isTmp(): ?bool
    {
        return $this->tmp;
    }

    public function setTmp(?bool $tmp): static
    {
        $this->tmp = $tmp;

        return $this;
    }

    public function isPersonalWarning(): ?bool
    {
        return $this->personal_warning;
    }

    public function setPersonalWarning(?bool $personal_warning): static
    {
        $this->personal_warning = $personal_warning;

        return $this;
    }

    public function isShortcutMenu(): ?bool
    {
        return $this->shortcut_menu;
    }

    public function setShortcutMenu(bool $shortcut_menu): static
    {
        $this->shortcut_menu = $shortcut_menu;

        return $this;
    }

    public function isSideShortcutMenu(): ?bool
    {
        return $this->side_shortcut_menu;
    }

    public function setSideShortcutMenu(bool $side_shortcut_menu): static
    {
        $this->side_shortcut_menu = $side_shortcut_menu;

        return $this;
    }

    public function getAsistenceNumber(): ?int
    {
        return $this->asistence_number;
    }

    public function setAsistenceNumber(?int $asistence_number): static
    {
        $this->asistence_number = $asistence_number;

        return $this;
    }

    public function getHighschoolEmail(): ?string
    {
        return $this->highschool_email;
    }

    public function setHighschoolEmail(?string $highschool_email): static
    {
        $this->highschool_email = $highschool_email;

        return $this;
    }

    public function getCaped(): ?int
    {
        return $this->caped;
    }

    public function setCaped(int $caped): static
    {
        $this->caped = $caped;

        return $this;
    }
}
