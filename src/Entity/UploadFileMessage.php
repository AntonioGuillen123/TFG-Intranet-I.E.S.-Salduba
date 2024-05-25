<?php

namespace App\Entity;

use App\Repository\UploadFileMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UploadFileMessageRepository::class)]
class UploadFileMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\Column(length: 15)]
    private ?string $extension = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $path = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $upload_date = null;

    public function __construct()
    {
        $this->upload_date = new \DateTime();
    }

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

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getUploadDate(): ?\DateTimeInterface
    {
        return $this->upload_date;
    }

    public function setUploadDate(\DateTimeInterface $upload_date): static
    {
        $this->upload_date = $upload_date;

        return $this;
    }
}