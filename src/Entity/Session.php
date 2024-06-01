<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'Este nombre de usuario ya está en uso')]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: 'El usuario no puede estar vacío')]
    private ?string $username = null;

    #[ORM\Column(length: 12)]
    #[Assert\NotBlank(message: 'La contraseña no puede estar vacía')]
    #[Assert\Regex(
        pattern: '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}$/',
        message: 'La contraseña debe contener al menos un dígito, una letra minúscula, una letra mayúscula y tener una longitud mínima de 12 caracteres.'
    )]
    private ?string $password = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,  options: ["default" => 3])]
    private ?UserRol $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getType(): ?UserRol
    {
        return $this->type;
    }

    public function setType(?UserRol $type): static
    {
        $this->type = $type;

        return $this;
    }
}